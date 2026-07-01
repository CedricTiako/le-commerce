<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Models\Statistic;
use App\Models\Wallet;
use App\Models\User;
use App\Models\OfferRedemption;
use App\Models\Poll;

class AdminStatisticsController extends Controller
{
    public function index(): void
    {
        Middleware::requireRole('admin');

        $this->view('admin/statistics/index', [
            'title'     => 'Statistiques — Administration Le Commerce',
            'pageTitle' => 'Statistiques',

            'walletActivity'    => Statistic::walletActivityLastDays(14),
            'paymentBreakdown'  => Statistic::paymentMethodBreakdown(),
            'newClientsByMonth' => Statistic::newClientsByMonth(6),
            'topClients'        => Statistic::topClientsBySpend(5),

            'totalBalance'        => Wallet::totalBalance(),
            'totalClients'        => User::countAll(),
            'offersUsed'          => OfferRedemption::countUsedThisMonth(),
            'pollsParticipations' => Poll::totalParticipations(),
        ], 'admin');
    }
}
