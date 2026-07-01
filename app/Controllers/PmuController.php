<?php

namespace App\Controllers;

use App\Core\Controller;

class PmuController extends Controller
{
    public function index(): void
    {
        $this->view('pages/placeholder', [
            'title'   => 'PMU — Le Commerce',
            'heading' => 'PMU',
            'text'    => "Les prochaines courses, pronostics et horaires PMU seront bientôt disponibles ici.",
        ]);
    }
}
