<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Models\User;
use App\Models\WhatsappMessage;

class AdminClientController extends Controller
{
    public function index(): void
    {
        Middleware::requireRole('admin');

        $filters = [
            'q'       => trim((string) $this->input('q', '')),
            'status'  => (string) $this->input('status', 'tous'),
            'segment' => (string) $this->input('segment', 'tous'),
            'from'    => (string) $this->input('from', ''),
            'to'      => (string) $this->input('to', ''),
        ];
        $page = max(1, (int) $this->input('page', 1));

        $result = User::paginateClients($filters, $page, 8);

        $this->view('admin/clients/index', [
            'title'      => 'Clients inscrits — Administration Le Commerce',
            'pageTitle'  => 'Clients inscrits',
            'clients'    => $result['data'],
            'total'      => $result['total'],
            'page'       => $result['page'],
            'perPage'    => $result['perPage'],
            'totalPages' => $result['totalPages'],
            'totalAll'   => User::countAll(),
            'newThisMonth' => User::countThisMonth(),
            'filters'    => $filters,
        ], 'admin');
    }

    /**
     * Export CSV de la liste filtrée (tous les résultats, sans pagination).
     */
    public function export(): void
    {
        Middleware::requireRole('admin');

        $filters = [
            'q'       => trim((string) $this->input('q', '')),
            'status'  => (string) $this->input('status', 'tous'),
            'segment' => (string) $this->input('segment', 'tous'),
            'from'    => (string) $this->input('from', ''),
            'to'      => (string) $this->input('to', ''),
        ];

        // perPage volontairement très large pour tout récupérer en un export
        $result = User::paginateClients($filters, 1, 100000);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="clients-le-commerce-' . date('Y-m-d') . '.csv"');

        $out = fopen('php://output', 'w');
        fwrite($out, "\xEF\xBB\xBF"); // BOM pour un affichage correct des accents dans Excel
        fputcsv($out, ['Prénom', 'Nom', 'Téléphone WhatsApp', 'E-mail', 'Segment', 'Statut', 'Solde portefeuille', 'Date d\'inscription'], ';');

        foreach ($result['data'] as $client) {
            fputcsv($out, [
                $client['first_name'],
                $client['last_name'],
                $client['phone_whatsapp'],
                $client['email'],
                $client['segment'],
                $client['status'],
                number_format((float) $client['wallet_balance'], 2, ',', ''),
                date('d/m/Y', strtotime($client['created_at'])),
            ], ';');
        }

        fclose($out);
        exit;
    }

    /**
     * Envoi (simulé pour ce lot) d'un message WhatsApp à un client depuis sa fiche.
     * L'intégration réelle à l'API WhatsApp Business sera branchée au Lot 9.
     */
    public function sendMessage(int $id): void
    {
        Middleware::requireRole('admin');
        $this->verifyCsrf();

        $client = User::find($id);
        if (!$client || $client['role'] !== 'client') {
            $this->setFlash('error', 'Client introuvable.');
            $this->redirect('/admin/clients');
            return;
        }

        $content = trim((string) $this->input('content', ''));
        if ($content !== '') {
            WhatsappMessage::create([
                'user_id'   => $id,
                'direction' => 'sortant',
                'content'   => $content,
            ]);
            $this->setFlash('success', 'Message envoyé à ' . $client['first_name'] . ' ' . $client['last_name'] . '.');
        }

        $this->redirect('/admin/clients');
    }
}
