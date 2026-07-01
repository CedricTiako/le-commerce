<div class="mb-6">
  <h1 class="font-extrabold text-2xl text-ink mb-1">Sondages & Votes</h1>
  <p class="text-gray-500 text-sm">Donnez votre avis et gagnez des récompenses !</p>
</div>

<?php if (empty($polls)): ?>
  <div class="bg-white border border-gray-100 rounded-2xl text-center py-16 px-6">
    <p class="text-gray-500 font-medium">Aucun sondage disponible pour le moment.</p>
    <p class="text-gray-400 text-sm mt-1">Revenez bientôt, de nouveaux sondages arrivent régulièrement !</p>
  </div>
<?php else: ?>
  <div class="grid sm:grid-cols-2 gap-5">
    <?php foreach ($polls as $poll): ?>
      <a href="<?= BASE_PATH ?>/mon-compte/sondages/<?= $poll['id'] ?>" class="block bg-white border border-gray-100 rounded-2xl p-6 hover:border-brand-200 hover:shadow-sm transition-all">
        <div class="flex items-start justify-between gap-3 mb-2">
          <p class="font-bold text-ink"><?= htmlspecialchars($poll['question']) ?></p>
          <?php if ($poll['has_voted']): ?>
            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 shrink-0">Répondu</span>
          <?php else: ?>
            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-brand-50 text-brand-500 shrink-0">Nouveau</span>
          <?php endif; ?>
        </div>
        <?php if ($poll['description']): ?><p class="text-sm text-gray-500 mb-3"><?= htmlspecialchars($poll['description']) ?></p><?php endif; ?>
        <p class="text-xs text-gray-400">Fin le <?= date('d/m/Y', strtotime($poll['ends_at'])) ?></p>
      </a>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
