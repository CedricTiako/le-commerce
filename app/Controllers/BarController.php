<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Drink;

class BarController extends Controller
{
    public function index(): void
    {
        $drinks = Drink::featured(100);
        $categories = ['biere_blonde' => [], 'biere_brune' => [], 'biere_ambree' => [], 'autre' => []];
        foreach ($drinks as $drink) {
            $categories[$drink['category']][] = $drink;
        }

        $this->view('pages/bar', [
            'title'      => 'Le Bar — Le Commerce',
            'heading'    => 'Le Bar',
            'categories' => $categories,
            'planches'   => [
                ['name' => 'Planche à saucisson', 'desc' => 'Saucisson sec, cornichons, fromage et pain frais.', 'price' => 8.5],
                ['name' => 'Planche mixte', 'desc' => 'Charcuterie, fromage et crudités de saison.', 'price' => 11.0],
                ['name' => 'Planche fromage', 'desc' => 'Sélection de fromages affinés et pain de campagne.', 'price' => 9.0],
            ],
            'softs' => ['Coca-Cola', 'Orangina', 'Jus de fruits pressés', 'Eaux plates & gazeuses', 'Café, thé & chocolat chaud'],
        ]);
    }
}
