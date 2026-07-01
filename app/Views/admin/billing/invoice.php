<div class="max-w-2xl mx-auto card card-md p-10">
  <div class="flex items-start justify-between mb-10">
    <div>
      <span class="font-logo text-[28px] font-bold text-brand-500 block -mb-1"><?= htmlspecialchars($shop['name']) ?></span>
      <p class="text-xs text-gray-400 mt-2"><?= htmlspecialchars($shop['address']) ?></p>
      <p class="text-xs text-gray-400"><?= htmlspecialchars($shop['zipcode'] . ' ' . $shop['city']) ?></p>
      <p class="text-xs text-gray-400"><?= htmlspecialchars($shop['email']) ?></p>
    </div>
    <div class="text-right">
      <h1 class="font-extrabold text-2xl text-ink">FACTURE</h1>
      <p class="text-sm text-gray-400 mt-1">N° <?= str_pad((string) $invoice['id'], 6, '0', STR_PAD_LEFT) ?></p>
      <p class="text-sm text-gray-400">Le <?= date('d/m/Y', strtotime($invoice['created_at'])) ?></p>
    </div>
  </div>

  <div class="grid grid-cols-2 gap-6 mb-10">
    <div>
      <p class="text-xs font-bold uppercase tracking-wide text-gray-400 mb-1">Facturé à</p>
      <p class="font-semibold text-ink"><?= htmlspecialchars($invoice['first_name'] . ' ' . $invoice['last_name']) ?></p>
      <?php if ($invoice['email']): ?><p class="text-sm text-gray-500"><?= htmlspecialchars($invoice['email']) ?></p><?php endif; ?>
      <p class="text-sm text-gray-500"><?= htmlspecialchars($invoice['phone_whatsapp']) ?></p>
    </div>
    <div class="text-right">
      <p class="text-xs font-bold uppercase tracking-wide text-gray-400 mb-1">Statut</p>
      <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600">Payée</span>
    </div>
  </div>

  <table class="w-full text-sm mb-10">
    <thead>
      <tr class="border-b-2 border-gray-100 text-left text-xs uppercase tracking-wide text-gray-400">
        <th class="pb-3 font-semibold">Description</th>
        <th class="pb-3 font-semibold text-right">Montant</th>
      </tr>
    </thead>
    <tbody>
      <tr class="border-b border-gray-50">
        <td class="py-4 text-ink"><?= htmlspecialchars($invoice['label'] ?? 'Recharge portefeuille') ?></td>
        <td class="py-4 text-right text-ink"><?= number_format($invoice['amount'], 2, ',', ' ') ?> €</td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td class="pt-4 font-extrabold text-ink text-right" colspan="1">Total TTC</td>
        <td class="pt-4 font-extrabold text-ink text-right text-lg"><?= number_format($invoice['amount'], 2, ',', ' ') ?> €</td>
      </tr>
    </tfoot>
  </table>

  <p class="text-xs text-gray-400 border-t border-gray-100 pt-6">
    Paiement effectué par carte bancaire le <?= date('d/m/Y à H:i', strtotime($invoice['created_at'])) ?>.
    Cette facture concerne une recharge de portefeuille fidélité, non soumise à TVA (usage interne à l'établissement).
  </p>
</div>
