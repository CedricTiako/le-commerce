<?php

namespace App\Controllers;

use App\Core\Controller;

class TabacController extends Controller
{
    public function index(): void
    {
        $this->view('pages/tabac', [
            'title'   => 'Tabac — Le Commerce',
            'heading' => 'Tabac',
            'categories' => [
                [
                    'name' => 'Cigarettes & tabac à rouler',
                    'desc' => 'Les grandes marques de cigarettes et de tabac à rouler, au prix officiel en vigueur.',
                    'icon' => 'M9 3v2m6-2v2M4 7h16M5 7h14v12a2 2 0 01-2 2H7a2 2 0 01-2-2V7z',
                ],
                [
                    'name' => 'Cigares & cigarillos',
                    'desc' => 'Une sélection de cigares et cigarillos pour les amateurs, à l’unité ou en boîte.',
                    'icon' => 'M4 12h16M4 12a2 2 0 100 4h10a2 2 0 100-4M4 12a2 2 0 110-4h10a2 2 0 110 4',
                ],
                [
                    'name' => 'Cigarette électronique',
                    'desc' => 'E-cigarettes, résistances et e-liquides dans un large choix de saveurs et de dosages.',
                    'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                ],
                [
                    'name' => 'Papiers, filtres & accessoires',
                    'desc' => 'Papiers à rouler, filtres, briquets, blagues à tabac et boîtes de rangement.',
                    'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l7-3 7 3z',
                ],
            ],
            'services' => [
                'Timbres fiscaux (amendes, passeport, titre de séjour...)',
                'Cartes prépayées de téléphonie mobile',
                'Recharges Paysafecard et Neosurf',
                'Vente de timbres postaux',
            ],
        ]);
    }
}
