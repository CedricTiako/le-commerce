<?php

namespace App\Controllers;

use App\Core\Controller;

class PresseController extends Controller
{
    public function index(): void
    {
        $this->view('pages/placeholder', [
            'title'   => 'Presse — Le Commerce',
            'heading' => 'Presse',
            'text'    => "La liste de nos titres de presse quotidienne et magazines sera bientôt en ligne.",
        ]);
    }
}
