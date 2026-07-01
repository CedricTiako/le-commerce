<?php

namespace App\Controllers;

use App\Core\Controller;

class TabacController extends Controller
{
    public function index(): void
    {
        $this->view('pages/placeholder', [
            'title'   => 'Tabac — Le Commerce',
            'heading' => 'Tabac',
            'text'    => "Retrouvez ici bientôt l'ensemble de nos produits tabac, cigarettes électroniques et accessoires.",
        ]);
    }
}
