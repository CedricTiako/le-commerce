<?php

namespace App\Models;

use App\Core\Model;

/**
 * Une "facture" correspond ici à une recharge de portefeuille payée par
 * carte bancaire (seul moyen de paiement facturable en ligne). Il n'y a
 * pas de table dédiée : on s'appuie directement sur `wallet_transactions`,
 * qui reste la source de vérité unique des mouvements financiers.
 */
class Invoice extends Model
{
    protected static string $table = 'wallet_transactions';

    private const WHERE = "wt.type = 'recharge' AND wt.payment_method = 'carte_bancaire' AND wt.status = 'reussi'";

    public static function paginate(int $page = 1, int $perPage = 10): array
    {
        $total = (int) self::db()->query(
            'SELECT COUNT(*) FROM wallet_transactions wt WHERE ' . self::WHERE
        )->fetchColumn();
        $totalPages = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;

        $stmt = self::db()->prepare(
            "SELECT wt.*, u.first_name, u.last_name, u.email
             FROM wallet_transactions wt
             JOIN wallets w ON w.id = wt.wallet_id
             JOIN users u ON u.id = w.user_id
             WHERE " . self::WHERE . "
             ORDER BY wt.created_at DESC
             LIMIT {$perPage} OFFSET {$offset}"
        );
        $stmt->execute();

        return [
            'data'       => $stmt->fetchAll(),
            'total'      => $total,
            'page'       => $page,
            'totalPages' => $totalPages,
        ];
    }

    public static function findWithDetails(int $id): ?array
    {
        $stmt = self::db()->prepare(
            "SELECT wt.*, u.first_name, u.last_name, u.email, u.phone_whatsapp
             FROM wallet_transactions wt
             JOIN wallets w ON w.id = wt.wallet_id
             JOIN users u ON u.id = w.user_id
             WHERE wt.id = :id AND " . self::WHERE
        );
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public static function totalRevenue(): float
    {
        return (float) self::db()->query(
            'SELECT COALESCE(SUM(amount), 0) FROM wallet_transactions wt WHERE ' . self::WHERE
        )->fetchColumn();
    }

    public static function totalRevenueThisMonth(): float
    {
        return (float) self::db()->query(
            "SELECT COALESCE(SUM(amount), 0) FROM wallet_transactions wt
             WHERE " . self::WHERE . " AND MONTH(wt.created_at) = MONTH(CURDATE()) AND YEAR(wt.created_at) = YEAR(CURDATE())"
        )->fetchColumn();
    }

    public static function countThisMonth(): int
    {
        return (int) self::db()->query(
            "SELECT COUNT(*) FROM wallet_transactions wt
             WHERE " . self::WHERE . " AND MONTH(wt.created_at) = MONTH(CURDATE()) AND YEAR(wt.created_at) = YEAR(CURDATE())"
        )->fetchColumn();
    }
}
