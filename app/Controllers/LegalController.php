<?php

namespace App\Controllers;

use App\Core\Controller;

class LegalController extends Controller
{
    public function mentionsLegales(): void
    {
        $this->view('pages/mentions-legales', [
            'title'   => 'Mentions légales — Le Commerce',
            'heading' => 'Mentions légales',
        ]);
    }

    public function cgu(): void
    {
        $this->view('pages/cgu', [
            'title'   => "Conditions Générales d'Utilisation — Le Commerce",
            'heading' => "Conditions Générales d'Utilisation",
        ]);
    }

    public function cgv(): void
    {
        $this->view('pages/cgv', [
            'title'   => 'Conditions Générales de Vente — Le Commerce',
            'heading' => 'Conditions Générales de Vente',
        ]);
    }

    public function confidentialite(): void
    {
        $this->view('pages/confidentialite', [
            'title'   => 'Politique de Confidentialité — Le Commerce',
            'heading' => 'Politique de Confidentialité & RGPD',
        ]);
    }
}
