<?php

namespace App\Controllers;

use App\Core\Controller;

class BarController extends Controller
{
    public function index(): void
    {
        $this->view('pages/placeholder', [
            'title'   => 'Le Bar — Le Commerce',
            'heading' => 'Le Bar',
            'text'    => "La carte complète de nos boissons, bières pression et planches à partager arrive dans le prochain lot de développement.",
        ]);
    }
}
