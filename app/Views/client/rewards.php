<div class="mb-6">
  <h1 class="font-extrabold text-2xl text-ink mb-1">Mes avantages</h1>
  <p class="text-gray-500 text-sm">Cumulez des points à chaque visite et débloquez des récompenses.</p>
</div>

<div class="bg-gradient-to-br from-brand-500 to-brand-700 rounded-2xl p-8 text-white mb-6">
  <p class="text-brand-100 text-sm font-semibold mb-2">Mon solde de points</p>
  <p class="font-extrabold text-5xl mb-4"><?= $points ?> <span class="text-2xl font-bold">pts</span></p>

  <?php if ($nextTier): ?>
    <?php $progress = $nextTier['threshold'] > 0 ? min(100, round(($points / $nextTier['threshold']) * 100)) : 0; ?>
    <p class="text-sm text-brand-50 mb-2">
      Plus que <strong><?= $nextTier['remaining'] ?> points</strong> pour débloquer : <?= htmlspecialchars($nextTier['label']) ?>
    </p>
    <div class="w-full bg-white/20 rounded-full h-2.5">
      <div class="bg-white h-2.5 rounded-full transition-all" style="width: <?= $progress ?>%"></div>
    </div>
  <?php else: ?>
    <p class="text-sm text-brand-50">Bravo, vous avez débloqué tous les paliers actuels ! 🎉</p>
  <?php endif; ?>
</div>

<div class="bg-white border border-gray-100 rounded-2xl p-6">
  <h2 class="font-bold text-ink mb-5">Paliers de récompenses</h2>
  <div class="space-y-3">
    <?php foreach ($tiers as $threshold => $label): ?>
      <?php $unlocked = $points >= $threshold; ?>
      <div class="flex items-center gap-4 p-4 rounded-xl <?= $unlocked ? 'bg-emerald-50' : 'bg-gray-50' ?>">
        <span class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm shrink-0
                     <?= $unlocked ? 'bg-emerald-500 text-white' : 'bg-gray-200 text-gray-500' ?>">
          <?php if ($unlocked): ?>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
          <?php else: ?>
            <?= $threshold ?>
          <?php endif; ?>
        </span>
        <div class="flex-1">
          <p class="font-semibold text-ink text-sm"><?= htmlspecialchars($label) ?></p>
          <p class="text-xs text-gray-400"><?= $threshold ?> points requis</p>
        </div>
        <?php if ($unlocked): ?>
          <span class="text-xs font-bold text-emerald-600 uppercase tracking-wide">Débloqué</span>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
  <p class="text-xs text-gray-400 mt-5">Le catalogue complet d'offres personnalisées (QR codes à usage unique, envoi WhatsApp) sera disponible prochainement.</p>
</div>
