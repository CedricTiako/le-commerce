<?php

namespace App\Controllers;

use App\Core\Controller;

class FdjController extends Controller
{
    public function index(): void
    {
        $this->view('pages/placeholder', [
            'title'   => 'FDJ — Le Commerce',
            'heading' => 'FDJ',
            'text'    => "Loto, Euromillions, jeux à gratter : la page FDJ complète arrive prochainement.",
        ]);
    }
}
