<p class="text-sm text-gray-500 mb-6">Historique des paiements par carte bancaire effectués par vos clients.</p>

<!-- KPIs -->
<div class="grid sm:grid-cols-3 gap-5 mb-6">
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <p class="text-sm font-semibold text-gray-500 mb-2">Chiffre d'affaires total</p>
    <p class="font-extrabold text-3xl text-ink"><?= number_format($totalRevenue, 2, ',', ' ') ?> €</p>
  </div>
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <p class="text-sm font-semibold text-gray-500 mb-2">Chiffre d'affaires ce mois</p>
    <p class="font-extrabold text-3xl text-ink"><?= number_format($totalRevenueMonth, 2, ',', ' ') ?> €</p>
  </div>
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <p class="text-sm font-semibold text-gray-500 mb-2">Factures ce mois</p>
    <p class="font-extrabold text-3xl text-ink"><?= $countThisMonth ?></p>
  </div>
</div>

<div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
  <?php if (empty($invoices)): ?>
    <div class="text-center py-16 px-6">
      <p class="text-gray-500 font-medium">Aucune facture pour le moment.</p>
      <p class="text-gray-400 text-sm mt-1">Les factures apparaissent automatiquement à chaque recharge par carte bancaire.</p>
    </div>
  <?php else: ?>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-gray-50">
          <tr class="text-left text-gray-500 text-xs uppercase tracking-wide">
            <th class="px-5 py-3 font-semibold">N° Facture</th>
            <th class="px-5 py-3 font-semibold">Client</th>
            <th class="px-5 py-3 font-semibold">Date</th>
            <th class="px-5 py-3 font-semibold">Montant</th>
            <th class="px-5 py-3 font-semibold text-right">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
          <?php foreach ($invoices as $inv): ?>
            <tr class="hover:bg-gray-50/50">
              <td class="px-5 py-3.5 font-mono text-gray-600">#<?= str_pad((string) $inv['id'], 6, '0', STR_PAD_LEFT) ?></td>
              <td class="px-5 py-3.5 font-semibold text-ink"><?= htmlspecialchars($inv['first_name'] . ' ' . $inv['last_name']) ?></td>
              <td class="px-5 py-3.5 text-gray-500"><?= date('d/m/Y', strtotime($inv['created_at'])) ?></td>
              <td class="px-5 py-3.5 font-semibold text-ink"><?= number_format($inv['amount'], 2, ',', ' ') ?> €</td>
              <td class="px-5 py-3.5 text-right">
                <a href="<?= BASE_PATH ?>/admin/facturation/<?= $inv['id'] ?>" class="text-xs font-bold text-brand-500 hover:underline">Voir la facture</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php if ($totalPages > 1): ?>
      <div class="flex items-center justify-center gap-1 px-5 py-4 border-t border-gray-50">
        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
          <a href="<?= BASE_PATH ?>/admin/facturation?page=<?= $p ?>"
             class="w-8 h-8 flex items-center justify-center rounded-lg text-sm font-semibold transition-colors <?= $p === $page ? 'bg-brand-500 text-white' : 'text-gray-500 hover:bg-gray-100' ?>">
            <?= $p ?>
          </a>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</div>
