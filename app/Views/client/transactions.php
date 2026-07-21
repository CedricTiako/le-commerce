<div class="mb-8">
  <h1 class="font-extrabold text-3xl text-ink mb-2">Mes transactions</h1>
  <p class="text-gray-500"><?= $total ?> transaction<?= $total > 1 ? 's' : '' ?> au total</p>
</div>

<?php if (empty($transactions)): ?>
  <div class="bg-white border border-gray-100 rounded-2xl text-center py-20 px-6">
    <span class="w-16 h-16 rounded-full bg-gray-100 text-gray-300 flex items-center justify-center mx-auto mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    </span>
    <p class="text-gray-600 font-semibold text-lg">Aucune transaction</p>
    <p class="text-gray-400 text-sm mt-1">Vos transactions apparaîtront ici</p>
  </div>
<?php else: ?>
  <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
          <tr class="text-left text-gray-600 text-xs uppercase font-bold tracking-wider">
            <th class="px-6 py-4">Type</th>
            <th class="px-6 py-4">Libellé</th>
            <th class="px-6 py-4">Paiement</th>
            <th class="px-6 py-4">Date</th>
            <th class="px-6 py-4 text-right">Montant</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <?php
            $typeLabels = ['recharge' => 'Recharge', 'debit' => 'Débit', 'remboursement' => 'Remboursement'];
            $paymentLabels = ['carte_bancaire' => 'Carte', 'especes' => 'Espèces', 'apple_pay' => 'Apple Pay', 'google_pay' => 'Google Pay', 'portefeuille' => 'Portefeuille'];
          ?>
          <?php foreach ($transactions as $tx): ?>
            <tr class="hover:bg-gray-50/50 transition-colors">
              <td class="px-6 py-4">
                <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-full <?= $tx['type'] === 'debit' ? 'bg-brand-100 text-brand-700' : 'bg-emerald-100 text-emerald-700' ?>">
                  <?= $tx['type'] === 'debit' ? '−' : '+' ?> <?= $typeLabels[$tx['type']] ?? ucfirst($tx['type']) ?>
                </span>
              </td>
              <td class="px-6 py-4 text-ink font-medium"><?= htmlspecialchars($tx['label'] ?? '—') ?></td>
              <td class="px-6 py-4 text-gray-600 text-xs"><?= $paymentLabels[$tx['payment_method']] ?? htmlspecialchars($tx['payment_method']) ?></td>
              <td class="px-6 py-4 text-gray-500 text-xs"><?= date('d/m/Y à H:i', strtotime($tx['created_at'])) ?></td>
              <td class="px-6 py-4 text-right font-bold <?= $tx['type'] === 'debit' ? 'text-brand-600' : 'text-emerald-600' ?>">
                <?= $tx['type'] === 'debit' ? '−' : '+' ?><?= number_format($tx['amount'], 2, ',', ' ') ?> €
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php if ($totalPages > 1): ?>
      <div class="flex items-center justify-center gap-1.5 px-6 py-5 border-t border-gray-100 bg-gray-50">
        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
          <a href="<?= BASE_PATH ?>/mon-compte/transactions?page=<?= $p ?>"
             class="w-10 h-10 flex items-center justify-center rounded-lg text-sm font-bold transition-all <?= $p === $page ? 'bg-brand-500 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-100' ?>">
            <?= $p ?>
          </a>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>
