<div class="max-w-2xl">
  <a href="<?= BASE_PATH ?>/admin/sondages" class="inline-flex items-center gap-1.5 text-sm font-semibold text-gray-500 hover:text-brand-500 mb-4">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    Retour aux sondages
  </a>

  <div class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8">
    <div class="flex items-start justify-between gap-4 mb-1">
      <h1 class="font-extrabold text-2xl text-ink"><?= htmlspecialchars($poll['question']) ?></h1>
      <?php
        $statusStyles = ['actif' => 'bg-emerald-50 text-emerald-600', 'programme' => 'bg-blue-50 text-blue-600', 'termine' => 'bg-gray-100 text-gray-500'];
        $statusLabels = ['actif' => 'Actif', 'programme' => 'Programmé', 'termine' => 'Terminé'];
      ?>
      <span class="text-xs font-semibold px-2.5 py-1 rounded-full shrink-0 <?= $statusStyles[$poll['status']] ?? '' ?>"><?= $statusLabels[$poll['status']] ?? $poll['status'] ?></span>
    </div>
    <?php if ($poll['description']): ?><p class="text-gray-500 text-sm mb-6"><?= htmlspecialchars($poll['description']) ?></p><?php endif; ?>

    <div class="space-y-4 mb-6">
      <?php foreach ($options as $opt): ?>
        <?php $pct = $total > 0 ? round(($opt['votes_count'] / $total) * 100) : 0; ?>
        <div>
          <div class="flex justify-between text-sm mb-1.5">
            <span class="font-semibold text-ink"><?= htmlspecialchars($opt['label']) ?></span>
            <span class="text-gray-500"><?= $opt['votes_count'] ?> vote<?= $opt['votes_count'] > 1 ? 's' : '' ?> · <?= $pct ?>%</span>
          </div>
          <div class="w-full bg-gray-100 rounded-full h-3">
            <div class="bg-brand-500 h-3 rounded-full transition-all" style="width: <?= $pct ?>%"></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="flex items-center justify-between border-t border-gray-100 pt-5 text-sm">
      <p class="text-gray-500"><strong class="text-ink"><?= $total ?></strong> participation<?= $total > 1 ? 's' : '' ?> au total</p>
      <p class="text-gray-500">Fin le <strong class="text-ink"><?= date('d/m/Y', strtotime($poll['ends_at'])) ?></strong></p>
    </div>
  </div>
</div>
