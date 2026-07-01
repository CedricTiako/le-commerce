<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;

class AdminDashboardController extends Controller
{
    public function index(): void
    {
        Middleware::requireRole('admin');

        $totalBalance   = Wallet::totalBalance();
        $balanceDelta   = WalletTransaction::netChange('this_month');

        $clientsWithWallet      = Wallet::count();
        $clientsWithWalletDelta = Wallet::countCreatedThisMonth();

        $rechargesThisMonth = WalletTransaction::countByType('recharge', 'this_month');
        $rechargesLastMonth = WalletTransaction::countByType('recharge', 'last_month');
        $rechargesDelta     = $rechargesThisMonth - $rechargesLastMonth;

        $expensesThisMonth = WalletTransaction::sumByType('debit', 'this_month');
        $expensesLastMonth = WalletTransaction::sumByType('debit', 'last_month');
        $expensesPercent   = $expensesLastMonth > 0
            ? round((($expensesThisMonth - $expensesLastMonth) / $expensesLastMonth) * 100)
            : null;

        $this->view('admin/dashboard', [
            'title'     => 'Tableau de bord — Administration Le Commerce',
            'pageTitle' => 'Tableau de bord',

            'totalBalance'   => $totalBalance,
            'balanceDelta'   => $balanceDelta,

            'clientsWithWallet'      => $clientsWithWallet,
            'clientsWithWalletDelta' => $clientsWithWalletDelta,

            'rechargesThisMonth' => $rechargesThisMonth,
            'rechargesDelta'     => $rechargesDelta,

            'expensesThisMonth' => $expensesThisMonth,
            'expensesPercent'   => $expensesPercent,

            'latestTransactions' => WalletTransaction::latestWithUser(5),
            'topClients'         => Wallet::topByBalance(5),

            'totalClients'      => User::countAll(),
            'newClientsThisMonth' => User::countThisMonth(),
        ], 'admin');
    }
}
