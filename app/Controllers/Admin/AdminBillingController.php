<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Models\Invoice;

class AdminBillingController extends Controller
{
    public function index(): void
    {
        Middleware::requireRole('admin');

        $page = max(1, (int) $this->input('page', 1));
        $result = Invoice::paginate($page, 10);

        $this->view('admin/billing/index', [
            'title'     => 'Facturation — Administration Le Commerce',
            'pageTitle' => 'Facturation',

            'invoices'   => $result['data'],
            'page'       => $result['page'],
            'totalPages' => $result['totalPages'],
            'total'      => $result['total'],

            'totalRevenue'      => Invoice::totalRevenue(),
            'totalRevenueMonth' => Invoice::totalRevenueThisMonth(),
            'countThisMonth'    => Invoice::countThisMonth(),
        ], 'admin');
    }

    /**
     * Facture imprimable (HTML) pour une transaction donnée.
     * L'utilisateur peut l'enregistrer en PDF via "Imprimer" du navigateur,
     * sans dépendance serveur supplémentaire (pas de librairie PDF).
     */
    public function show(int $id): void
    {
        Middleware::requireRole('admin');

        $invoice = Invoice::findWithDetails($id);
        if (!$invoice) {
            $this->setFlash('error', 'Facture introuvable.');
            $this->redirect('/admin/facturation');
            return;
        }

        // Vue autonome (sans layout admin) pour une impression propre
        $this->view('admin/billing/invoice', [
            'title'   => 'Facture #' . str_pad((string) $invoice['id'], 6, '0', STR_PAD_LEFT),
            'invoice' => $invoice,
        ], 'invoice');
    }
}
