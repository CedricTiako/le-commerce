<div class="space-y-6">
  <?php
  $pageTitle = 'Portefeuille client';
  $pageSubtitle = 'Suivez le flux de recharges, le solde global et les clients qui dépensent le plus.';
  $pageActions = [
    ['href' => BASE_PATH . '/admin/clients', 'label' => 'Voir les clients', 'class' => 'btn-primary'],
  ];
  require __DIR__ . '/../partials/admin-page-header.php';
  ?>

  <div class="grid gap-5 lg:grid-cols-4">
    <div class="card card-md">
      <p class="text-xs uppercase tracking-[0.2em] text-gray-500 font-semibold mb-3">Solde total</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($totalBalance, 2, ',', ' ') ?> €</p>
      <p class="text-xs text-gray-400 mt-2">Solde cumulatif de tous les portefeuilles</p>
    </div>
    <div class="card card-md">
      <p class="text-xs uppercase tracking-[0.2em] text-gray-500 font-semibold mb-3">Portefeuilles</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($walletCount) ?></p>
      <p class="text-xs text-gray-400 mt-2">Clients disposant d’un portefeuille</p>
    </div>
    <div class="card card-md">
      <p class="text-xs uppercase tracking-[0.2em] text-gray-500 font-semibold mb-3">Recharges</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($rechargesThisMonth) ?></p>
      <p class="text-xs text-gray-400 mt-2">Transactions de recharge ce mois</p>
    </div>
    <div class="card card-md">
      <p class="text-xs uppercase tracking-[0.2em] text-gray-500 font-semibold mb-3">Top clients</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format(count($topClients)) ?></p>
      <p class="text-xs text-gray-400 mt-2">Clients les mieux crédités</p>
    </div>
  </div>

  <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
    <div class="card card-md">
      <div class="flex items-center justify-between mb-4">
        <div>
          <p class="text-sm font-semibold text-gray-500 uppercase tracking-[0.18em]">Dernières transactions</p>
          <h2 class="text-xl font-bold text-ink">Historique rapide</h2>
        </div>
        <a href="<?= BASE_PATH ?>/admin/clients" class="text-sm font-semibold text-brand-500 hover:underline">Voir les clients</a>
      </div>

      <?php if (empty($latestTransactions)): ?>
        <p class="text-sm text-gray-400 py-8 text-center">Aucune transaction récente.</p>
      <?php else: ?>
        <div class="overflow-x-auto -mx-4 px-4">
          <table class="min-w-full text-sm">
            <thead>
              <tr class="text-left text-gray-400 text-xs uppercase tracking-wide">
                <th class="px-2 py-2">Client</th>
                <th class="px-2 py-2">Type</th>
                <th class="px-2 py-2">Montant</th>
                <th class="px-2 py-2">Moyen</th>
                <th class="px-2 py-2">Date</th>
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
                  <td class="px-2 py-3 text-gray-500"><?= htmlspecialchars(str_replace('_', ' ', $tx['payment_method'])) ?></td>
                  <td class="px-2 py-3 text-gray-500"><?= date('d/m/Y', strtotime($tx['created_at'])) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>

    <div class="card card-md bg-brand-50 border-brand-100 text-brand-900">
      <h2 class="font-bold text-ink mb-4">Gestion portefeuille</h2>
      <p class="text-sm leading-6">Les portefeuilles clients renforcent la fidélité et facilitent les paiements en boutique. Vérifiez régulièrement les recharges et les comptes inactifs.</p>
      <div class="mt-6 space-y-3 text-sm text-brand-900/90">
        <div class="rounded-3xl bg-white/80 p-4">
          <p class="font-semibold">Conseils</p>
          <p class="mt-2">Proposez des recharges rapides et des codes d’offre pour inciter à revenir en boutique.</p>
        </div>
      </div>
    </div>
  </div>
</div>
