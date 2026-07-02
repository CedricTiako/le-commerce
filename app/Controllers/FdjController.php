<?php

namespace App\Controllers;

use App\Core\Controller;

class FdjController extends Controller
{
    public function index(): void
    {
        $this->view('pages/fdj', [
            'title'   => 'FDJ — Le Commerce',
            'heading' => 'FDJ',
            'categories' => [
                [
                    'name' => 'Loto & Euromillions',
                    'desc' => 'Tentez le jackpot avec les grands tirages nationaux et européens, plusieurs fois par semaine.',
                    'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                    'slug' => 'fdj_loto_euromillions',
                ],
                [
                    'name' => 'Illiko (jeux à gratter)',
                    'desc' => 'Un large choix de tickets à gratter, du plus accessible aux plus gros gains instantanés.',
                    'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z',
                    'slug' => 'fdj_illiko',
                ],
                [
                    'name' => 'Amigo & Keno',
                    'desc' => 'Des tirages toutes les 5 minutes pour jouer et connaître le résultat presque immédiatement.',
                    'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                    'slug' => 'fdj_amigo_keno',
                ],
                [
                    'name' => 'Rapido & jeux express',
                    'desc' => 'Des jeux rapides et accessibles à tout moment de la journée, pour un plaisir immédiat.',
                    'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10',
                    'slug' => 'fdj_rapido',
                ],
            ],
            'services' => [
                'Vérification de vos tickets gagnants en caisse',
                'Suivi des jackpots en cours et des prochains tirages',
                'Retrait des gains jusqu\'au montant autorisé en boutique',
                'Conseils sur les jeux et abonnements',
            ],
        ]);
    }
}
