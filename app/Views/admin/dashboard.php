<?php
function kpiDelta(float $value, string $suffix = ''): string
{
    if ($value == 0) return '';
    $sign = $value > 0 ? '+' : '';
    return $sign . number_format($value, 2, ',', ' ') . $suffix;
}
?>

<!-- KPIs -->
<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

  <div class="card card-md">
    <div class="flex items-center gap-3 mb-3">
      <span class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2m-9-5h9m0 0l-3-3m3 3l-3 3"/></svg>
      </span>
      <p class="text-sm font-semibold text-gray-500">Portefeuilles clients</p>
    </div>
    <p class="font-extrabold text-3xl text-ink"><?= number_format($totalBalance, 2, ',', ' ') ?> €</p>
    <?php if ($balanceDelta != 0): ?>
      <p class="text-xs font-semibold <?= $balanceDelta > 0 ? 'text-emerald-500' : 'text-brand-500' ?> mt-1">
        <?= kpiDelta($balanceDelta, ' € ce mois-ci') ?>
      </p>
    <?php else: ?>
      <p class="text-xs text-gray-400 mt-1">Aucun mouvement ce mois-ci</p>
    <?php endif; ?>
  </div>

  <div class="card card-md">
    <div class="flex items-center gap-3 mb-3">
      <span class="w-10 h-10 rounded-2xl bg-brand-50 text-brand-500 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"/></svg>
      </span>
      <p class="text-sm font-semibold text-gray-500">Clients avec portefeuille</p>
    </div>
    <p class="font-extrabold text-3xl text-ink"><?= $clientsWithWallet ?></p>
    <p class="text-xs font-semibold text-emerald-500 mt-1">
      <?= $clientsWithWalletDelta > 0 ? '+' . $clientsWithWalletDelta . ' ce mois-ci' : 'Aucun nouveau ce mois-ci' ?>
    </p>
  </div>

  <div class="card card-md">
    <div class="flex items-center gap-3 mb-3">
      <span class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v8m-4-5v5m8-9v9M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
      </span>
      <p class="text-sm font-semibold text-gray-500">Recharges ce mois</p>
    </div>
    <p class="font-extrabold text-3xl text-ink"><?= $rechargesThisMonth ?></p>
    <p class="text-xs font-semibold <?= $rechargesDelta >= 0 ? 'text-emerald-500' : 'text-brand-500' ?> mt-1">
      <?= ($rechargesDelta >= 0 ? '+' : '') . $rechargesDelta ?> vs mois dernier
    </p>
  </div>

  <div class="card card-md">
    <div class="flex items-center gap-3 mb-3">
      <span class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
      </span>
      <p class="text-sm font-semibold text-gray-500">Dépenses ce mois</p>
    </div>
    <p class="font-extrabold text-3xl text-ink"><?= number_format($expensesThisMonth, 2, ',', ' ') ?> €</p>
    <p class="text-xs font-semibold text-gray-400 mt-1">
      <?= $expensesPercent === null ? 'Pas de comparaison disponible' : (($expensesPercent >= 0 ? '+' : '') . $expensesPercent . '% vs mois dernier') ?>
    </p>
  </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">

  <!-- Dernières transactions -->
  <div class="lg:col-span-2 card card-md">
    <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between mb-4">
      <h2 class="font-bold text-ink">Dernières transactions portefeuille</h2>
      <a href="<?= BASE_PATH ?>/admin/portefeuilles" class="text-xs font-semibold text-brand-500 hover:underline">Voir toutes les transactions</a>
    </div>

    <?php if (empty($latestTransactions)): ?>
      <p class="text-sm text-gray-400 py-8 text-center">Aucune transaction pour le moment.</p>
    <?php else: ?>
      <div class="overflow-x-auto -mx-4 px-4">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="text-left text-gray-400 text-xs uppercase tracking-wide">
              <th class="px-2 py-2 font-semibold">Client</th>
              <th class="px-2 py-2 font-semibold">Type</th>
              <th class="px-2 py-2 font-semibold">Montant</th>
              <th class="px-2 py-2 font-semibold">Date</th>
              <th class="px-2 py-2 font-semibold">Statut</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-50">
            <?php foreach ($latestTransactions as $tx): ?>
              <tr>
                <td class="px-2 py-3">
                  <p class="font-semibold text-ink"><?= htmlspecialchars($tx['first_name'] . ' ' . $tx['last_name']) ?></p>
                  <p class="text-xs text-gray-400"><?= htmlspecialchars($tx['phone_whatsapp']) ?></p>
                </td>
                <td class="px-2 py-3 capitalize text-gray-600"><?= htmlspecialchars($tx['type']) ?></td>
                <td class="px-2 py-3 font-semibold <?= $tx['type'] === 'debit' ? 'text-brand-500' : 'text-emerald-500' ?>">
                  <?= $tx['type'] === 'debit' ? '-' : '+' ?><?= number_format($tx['amount'], 2, ',', ' ') ?> €
                </td>
                <td class="px-2 py-3 text-gray-500"><?= date('d/m/Y à H:i', strtotime($tx['created_at'])) ?></td>
                <td class="px-2 py-3">
                  <span class="text-xs font-semibold px-2 py-1 rounded-full
                        <?= $tx['status'] === 'reussi' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' ?>">
                    <?= ucfirst($tx['status']) ?>
                  </span>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>

  <!-- Top 5 clients -->
  <div class="card card-md">
    <div class="flex items-center justify-between mb-4">
      <h2 class="font-bold text-ink">Top 5 des clients (solde)</h2>
      <a href="<?= BASE_PATH ?>/admin/clients" class="text-xs font-semibold text-brand-500 hover:underline">Voir tout</a>
    </div>

    <?php if (empty($topClients)): ?>
      <p class="text-sm text-gray-400 py-8 text-center">Aucun client pour le moment.</p>
    <?php else: ?>
      <ul class="space-y-3">
        <?php foreach ($topClients as $c): ?>
          <li class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <span class="w-9 h-9 rounded-full bg-brand-50 text-brand-500 flex items-center justify-center text-xs font-bold">
                <?= htmlspecialchars(mb_substr($c['first_name'], 0, 1) . mb_substr($c['last_name'], 0, 1)) ?>
              </span>
              <div>
                <p class="font-semibold text-ink text-sm"><?= htmlspecialchars($c['first_name'] . ' ' . $c['last_name']) ?></p>
                <p class="text-xs text-gray-400"><?= htmlspecialchars($c['phone_whatsapp']) ?></p>
              </div>
            </div>
            <p class="font-bold text-ink text-sm"><?= number_format($c['balance'], 2, ',', ' ') ?> €</p>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>
