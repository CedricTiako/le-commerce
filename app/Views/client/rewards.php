<div class="mb-8">
  <h1 class="font-extrabold text-3xl text-ink mb-2">Mes avantages fidélité</h1>
  <p class="text-gray-500">Cumulez des points à chaque visite et débloquez des récompenses exclusives.</p>
</div>

<div class="bg-gradient-to-br from-amber-400 via-brand-500 to-brand-600 rounded-2xl p-8 text-white mb-8 shadow-lg hover-lift">
  <p class="text-white/80 text-sm font-semibold mb-2">Mon solde de points</p>
  <p class="font-extrabold text-5xl mb-4"><?= $points ?> <span class="text-2xl font-bold">⭐</span></p>

  <?php if ($nextTier): ?>
    <?php $progress = $nextTier['threshold'] > 0 ? min(100, round(($points / $nextTier['threshold']) * 100)) : 0; ?>
    <p class="text-sm text-white/90 mb-3">
      Plus que <strong><?= $nextTier['remaining'] ?> points</strong> pour : <?= htmlspecialchars($nextTier['label']) ?>
    </p>
    <div class="w-full bg-white/20 rounded-full h-3">
      <div class="bg-white h-3 rounded-full transition-all duration-500" style="width: <?= $progress ?>%"></div>
    </div>
  <?php else: ?>
    <p class="text-sm text-white/90">✨ Bravo, vous avez débloqué tous les paliers actuels !</p>
  <?php endif; ?>
</div>

<div class="bg-white border border-gray-100 rounded-2xl p-8">
  <h2 class="font-bold text-ink mb-6 text-lg">Paliers de récompenses</h2>
  <div class="space-y-4">
    <?php foreach ($tiers as $threshold => $label): ?>
      <?php $unlocked = $points >= $threshold; ?>
      <div class="flex items-center gap-4 p-5 rounded-xl border transition-all hover-lift <?= $unlocked ? 'bg-emerald-50 border-emerald-200' : 'bg-gray-50 border-gray-100' ?>">
        <span class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-sm shrink-0 flex-none
                     <?= $unlocked ? 'bg-emerald-500 text-white' : 'bg-gray-200 text-gray-500' ?>">
          <?php if ($unlocked): ?>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
          <?php else: ?>
            <?= $threshold ?>
          <?php endif; ?>
        </span>
        <div class="flex-1 min-w-0">
          <p class="font-semibold text-ink"><?= htmlspecialchars($label) ?></p>
          <p class="text-xs text-gray-400"><?= $threshold ?> points requis</p>
        </div>
        <?php if ($unlocked): ?>
          <span class="text-xs font-bold text-emerald-600 uppercase tracking-wide whitespace-nowrap ml-2">Débloqué</span>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
  <p class="text-xs text-gray-400 mt-6 pt-6 border-t border-gray-100">🎁 Le catalogue complet d'offres personnalisées (QR codes à usage unique, envoi WhatsApp) sera disponible dans les prochains lots.</p>
</div>
