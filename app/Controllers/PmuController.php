<?php

namespace App\Controllers;

use App\Core\Controller;

class PmuController extends Controller
{
    public function index(): void
    {
        $this->view('pages/pmu', [
            'title'   => 'PMU — Le Commerce',
            'heading' => 'PMU',
            'categories' => [
                [
                    'name' => 'Simple gagnant / placé',
                    'desc' => 'Le pari le plus simple : misez sur le cheval qui gagnera ou terminera dans les premières places.',
                    'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                    'slug' => 'pmu_simple_gagnant_place',
                ],
                [
                    'name' => 'Couplé & Trio',
                    'desc' => 'Pronostiquez plusieurs chevaux dans l\'ordre ou le désordre pour un gain plus important.',
                    'icon' => 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4',
                    'slug' => 'pmu_couple_trio',
                ],
                [
                    'name' => 'Quinté+',
                    'desc' => 'Le pari phare de la course du jour : trouvez les 5 premiers chevaux pour maximiser vos gains.',
                    'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z',
                    'slug' => 'pmu_quinte',
                ],
                [
                    'name' => 'Multi',
                    'desc' => 'Choisissez de 4 à 10 chevaux et tentez de retrouver les 4 premiers de l\'arrivée, dans l\'ordre ou non.',
                    'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14',
                    'slug' => 'pmu_multi',
                ],
            ],
            'services' => [
                'Toutes les courses du jour, en France et à l\'international',
                'Retransmission des courses phares en boutique',
                'Retrait des gains en espèces directement en caisse',
                'Conseils et pronostics de nos équipes',
            ],
        ]);
    }
}
