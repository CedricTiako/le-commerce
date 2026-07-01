<div class="mb-6">
  <h1 class="font-extrabold text-2xl text-ink mb-1">Parrainage</h1>
  <p class="text-gray-500 text-sm">Partagez votre code et gagnez 10 € de crédit par ami parrainé.</p>
</div>

<div class="grid lg:grid-cols-2 gap-6">
  <div class="bg-ink rounded-2xl p-8 text-white">
    <p class="text-gray-400 text-sm font-semibold mb-2">Votre code de parrainage</p>
    <p class="font-mono font-extrabold text-3xl tracking-widest text-brand-500 mb-6"><?= htmlspecialchars($user['referral_code'] ?? '—') ?></p>

    <div class="flex items-center gap-2 bg-white/5 border border-white/10 rounded-lg px-4 py-3 mb-4">
      <input type="text" readonly value="<?= htmlspecialchars($shop['url'] ?? '') ?>/inscription?parrain=<?= htmlspecialchars($user['referral_code'] ?? '') ?>"
             id="referral-link" class="flex-1 bg-transparent text-sm text-gray-200 focus:outline-none">
      <button type="button" onclick="navigator.clipboard.writeText(document.getElementById('referral-link').value); this.textContent='Copié !'"
              class="text-xs font-bold text-brand-500 hover:text-brand-400 shrink-0">Copier</button>
    </div>

    <p class="text-sm text-gray-400">
      Dès que votre ami s'inscrit avec ce code et effectue sa première recharge, vous recevez automatiquement
      10 € de crédit sur votre portefeuille.
    </p>
  </div>

  <div class="bg-white border border-gray-100 rounded-2xl p-8 text-center flex flex-col items-center justify-center">
    <span class="w-16 h-16 rounded-full bg-brand-50 text-brand-500 flex items-center justify-center mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"/></svg>
    </span>
    <p class="font-extrabold text-4xl text-ink mb-1"><?= $referralCount ?></p>
    <p class="text-gray-500 text-sm">filleul<?= $referralCount > 1 ? 's' : '' ?> parrainé<?= $referralCount > 1 ? 's' : '' ?></p>
  </div>
</div>
