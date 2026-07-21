<?php

namespace App\Controllers;

use App\Core\Controller;

class ActualitesController extends Controller
{
    public function index(): void
    {
        $this->view('pages/placeholder', [
            'title'   => 'Actualités - Le Commerce',
            'heading' => 'Actualités',
            'text'    => 'Les actualités et événements du Commerce arrivent très bientôt!',
        ]);
    }
}
