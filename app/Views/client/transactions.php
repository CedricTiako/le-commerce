<div class="mb-6">
  <h1 class="font-extrabold text-2xl text-ink mb-1">Mes transactions</h1>
  <p class="text-gray-500 text-sm"><?= $total ?> transaction<?= $total > 1 ? 's' : '' ?> au total</p>
</div>

<div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
  <?php if (empty($transactions)): ?>
    <div class="text-center py-16 px-6">
      <p class="text-gray-500 font-medium">Aucune transaction pour le moment.</p>
    </div>
  <?php else: ?>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-gray-50">
          <tr class="text-left text-gray-500 text-xs uppercase tracking-wide">
            <th class="px-5 py-3 font-semibold">Type</th>
            <th class="px-5 py-3 font-semibold">Libellé</th>
            <th class="px-5 py-3 font-semibold">Moyen de paiement</th>
            <th class="px-5 py-3 font-semibold">Date</th>
            <th class="px-5 py-3 font-semibold text-right">Montant</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
          <?php
            $typeLabels = ['recharge' => 'Recharge', 'debit' => 'Débit', 'remboursement' => 'Remboursement'];
            $paymentLabels = ['carte_bancaire' => 'Carte bancaire', 'especes' => 'Espèces', 'apple_pay' => 'Apple Pay', 'google_pay' => 'Google Pay', 'portefeuille' => 'Portefeuille'];
          ?>
          <?php foreach ($transactions as $tx): ?>
            <tr class="hover:bg-gray-50/50">
              <td class="px-5 py-3.5">
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full <?= $tx['type'] === 'debit' ? 'bg-brand-50 text-brand-600' : 'bg-emerald-50 text-emerald-600' ?>">
                  <?= $typeLabels[$tx['type']] ?? ucfirst($tx['type']) ?>
                </span>
              </td>
              <td class="px-5 py-3.5 text-ink"><?= htmlspecialchars($tx['label'] ?? '—') ?></td>
              <td class="px-5 py-3.5 text-gray-500"><?= $paymentLabels[$tx['payment_method']] ?? htmlspecialchars($tx['payment_method']) ?></td>
              <td class="px-5 py-3.5 text-gray-500"><?= date('d/m/Y à H:i', strtotime($tx['created_at'])) ?></td>
              <td class="px-5 py-3.5 text-right font-bold <?= $tx['type'] === 'debit' ? 'text-brand-500' : 'text-emerald-500' ?>">
                <?= $tx['type'] === 'debit' ? '-' : '+' ?><?= number_format($tx['amount'], 2, ',', ' ') ?> €
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php if ($totalPages > 1): ?>
      <div class="flex items-center justify-center gap-1 px-5 py-4 border-t border-gray-50">
        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
          <a href="<?= BASE_PATH ?>/mon-compte/transactions?page=<?= $p ?>"
             class="w-8 h-8 flex items-center justify-center rounded-lg text-sm font-semibold transition-colors
                    <?= $p === $page ? 'bg-brand-500 text-white' : 'text-gray-500 hover:bg-gray-100' ?>">
            <?= $p ?>
          </a>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</div>
