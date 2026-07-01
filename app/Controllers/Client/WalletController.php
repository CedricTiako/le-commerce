<?php

namespace App\Controllers\Client;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Middleware;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;

class WalletController extends Controller
{
    /** Montants autorisés pour une recharge en ligne, en euros. */
    private const ALLOWED_AMOUNTS = [10, 20, 50, 100, 150];
    private const MIN_CUSTOM = 5;
    private const MAX_CUSTOM = 500;
    private const BONUS_THRESHOLD = 50;
    private const BONUS_AMOUNT = 2;

    /**
     * Traite une recharge de portefeuille (paiement simulé pour ce lot —
     * l'intégration Stripe réelle nécessite des clés API à fournir).
     */
    public function recharge(): void
    {
        Middleware::requireRole('client');
        $this->verifyCsrf();

        $user   = Middleware::user();
        $wallet = Wallet::findByUser($user['id']);

        if (!$wallet) {
            $this->setFlash('error', 'Portefeuille introuvable.');
            $this->redirect('/mon-compte');
            return;
        }

        $choice = (string) $this->input('amount_choice', '');
        $amount = $choice === 'autre'
            ? (float) $this->input('custom_amount', 0)
            : (float) $choice;

        if ($choice !== 'autre' && !in_array((int) $choice, self::ALLOWED_AMOUNTS, true)) {
            $this->setFlash('error', 'Montant de recharge invalide.');
            $this->redirect('/mon-compte');
            return;
        }

        if ($amount < self::MIN_CUSTOM || $amount > self::MAX_CUSTOM) {
            $this->setFlash('error', 'Le montant doit être compris entre ' . self::MIN_CUSTOM . ' € et ' . self::MAX_CUSTOM . ' €.');
            $this->redirect('/mon-compte');
            return;
        }

        $paymentMethod = in_array($this->input('payment_method'), ['carte_bancaire', 'apple_pay', 'google_pay'], true)
            ? $this->input('payment_method')
            : 'carte_bancaire';

        $bonus = ((int) $amount === self::BONUS_THRESHOLD) ? self::BONUS_AMOUNT : 0;

        $pdo = Database::connection();
        $pdo->beginTransaction();
        try {
            Wallet::adjustBalance((int) $wallet['id'], $amount + $bonus);

            WalletTransaction::create([
                'wallet_id'      => $wallet['id'],
                'type'           => 'recharge',
                'amount'         => $amount,
                'payment_method' => $paymentMethod,
                'status'         => 'reussi',
                'label'          => 'Recharge portefeuille',
            ]);

            if ($bonus > 0) {
                WalletTransaction::create([
                    'wallet_id'      => $wallet['id'],
                    'type'           => 'recharge',
                    'amount'         => $bonus,
                    'payment_method' => $paymentMethod,
                    'status'         => 'reussi',
                    'label'          => 'Bonus fidélité',
                ]);
            }

            $pdo->commit();
        } catch (\Throwable $e) {
            $pdo->rollBack();
            $this->setFlash('error', 'La recharge a échoué. Merci de réessayer.');
            $this->redirect('/mon-compte');
            return;
        }

        $message = 'Recharge de ' . number_format($amount, 2, ',', ' ') . ' € effectuée avec succès !';
        if ($bonus > 0) {
            $message .= ' (+' . $bonus . ' € offerts 🎁)';
        }
        $this->setFlash('success', $message);
        $this->redirect('/mon-compte');
    }

    /**
     * Historique complet et paginé des transactions du client.
     */
    public function transactions(): void
    {
        Middleware::requireRole('client');

        $user = Middleware::user();
        $page = max(1, (int) $this->input('page', 1));

        $result = WalletTransaction::forUserPaginated($user['id'], $page, 10);

        $this->view('client/transactions', [
            'title'        => 'Mes transactions — Le Commerce',
            'user'         => $user,
            'transactions' => $result['data'],
            'total'        => $result['total'],
            'page'         => $result['page'],
            'totalPages'   => $result['totalPages'],
        ], 'client');
    }

    /**
     * Page avantages fidélité (points, prochain palier).
     * Le catalogue d'offres complet arrive avec le Lot 6.
     */
    public function rewards(): void
    {
        Middleware::requireRole('client');

        $user = Middleware::user();
        $points = (int) $user['loyalty_points'];

        // Paliers simples de démonstration (seront pilotés par l'admin au Lot 6)
        $tiers = [
            10  => 'Café offert',
            50  => 'Planche à saucisson -20 %',
            100 => 'Boisson offerte',
            150 => 'Happy Hour VIP illimité (1 soirée)',
        ];
        $nextTier = null;
        foreach ($tiers as $threshold => $label) {
            if ($points < $threshold) {
                $nextTier = ['threshold' => $threshold, 'label' => $label, 'remaining' => $threshold - $points];
                break;
            }
        }

        $this->view('client/rewards', [
            'title'    => 'Mes avantages — Le Commerce',
            'user'     => $user,
            'points'   => $points,
            'tiers'    => $tiers,
            'nextTier' => $nextTier,
        ], 'client');
    }

    /**
     * Page de parrainage (code personnel + nombre de filleuls).
     */
    public function referral(): void
    {
        Middleware::requireRole('client');

        $user = Middleware::user();

        $this->view('client/referral', [
            'title'         => 'Parrainage — Le Commerce',
            'user'          => $user,
            'referralCount' => User::countReferrals($user['id']),
        ], 'client');
    }
}
