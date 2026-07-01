<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Drink;
use App\Models\Deal;
use App\Models\GoogleReview;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('home/index', [
            'title'   => 'Le Commerce — Bar, Tabac, PMU, FDJ, Presse à Forges-les-Eaux',
            'drinks'  => Drink::featured(10),
            'deal'    => Deal::current(),
            'reviews' => GoogleReview::latest(3),
        ]);
    }
}
