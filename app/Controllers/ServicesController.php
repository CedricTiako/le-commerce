<?php

namespace App\Controllers;

use App\Core\Controller;

class ServicesController extends Controller
{
    public function index(): void
    {
        $this->view('pages/placeholder', [
            'title'   => 'Nos Services — Le Commerce',
            'heading' => 'Nos Services du Quotidien',
            'text'    => "Paiement de factures, amendes, Paysafecard, BlaBlaCar, relais colis, retrait d'espèces... Le détail complet arrive bientôt.",
        ]);
    }
}
