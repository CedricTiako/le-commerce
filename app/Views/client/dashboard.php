<?php use App\Core\Csrf; ?>

<!-- En-tête -->
<div class="mb-8">
  <h1 class="font-extrabold text-3xl text-ink mb-2">Bienvenue <?= htmlspecialchars($user['first_name']) ?> 👋</h1>
  <p class="text-gray-500">Voici un aperçu de votre compte et de vos activités au Commerce.</p>
</div>

<!-- KPIs principales -->
<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

  <!-- Portefeuille -->
  <div class="reveal bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl p-6 text-white shadow-lg hover-lift">
    <div class="flex items-center justify-between mb-4">
      <div>
        <p class="text-emerald-100 text-sm font-semibold mb-2">Mon portefeuille</p>
        <p class="font-extrabold text-3xl"><?= number_format($wallet['balance'], 2, ',', ' ') ?> €</p>
      </div>
      <svg class="w-12 h-12 opacity-20" fill="currentColor" viewBox="0 0 24 24"><path d="M17 8H5c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm0 12H5V10h14v10zM6 13h12v2H6z"/></svg>
    </div>
    <a href="#recharger" class="inline-flex items-center justify-center w-full mt-4 bg-white text-emerald-600 font-bold text-sm px-4 py-2.5 rounded-lg hover:bg-emerald-50 transition-all">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
      Recharger
    </a>
  </div>

  <!-- Dernière transaction -->
  <div class="reveal bg-white border border-gray-100 rounded-2xl p-6 hover-lift" style="transition-delay:50ms;">
    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider mb-3">Dernière transaction</p>
    <?php if ($lastTransaction): ?>
      <p class="font-extrabold text-2xl mb-1 <?= $lastTransaction['type'] === 'debit' ? 'text-brand-500' : 'text-emerald-500' ?>">
        <?= $lastTransaction['type'] === 'debit' ? '−' : '+' ?><?= number_format($lastTransaction['amount'], 2, ',', ' ') ?> €
      </p>
      <p class="text-xs text-gray-400"><?= htmlspecialchars($lastTransaction['label'] ?? ucfirst($lastTransaction['type'])) ?></p>
      <p class="text-xs text-gray-400 mt-0.5"><?= date('d/m/Y à H:i', strtotime($lastTransaction['created_at'])) ?></p>
      <a href="<?= BASE_PATH ?>/mon-compte/transactions" class="inline-flex items-center gap-1 text-xs font-bold text-brand-500 hover:text-brand-600 mt-3 transition-colors">
        Voir plus →
      </a>
    <?php else: ?>
      <p class="text-gray-400 text-sm mt-2">Aucune transaction pour le moment</p>
    <?php endif; ?>
  </div>

  <!-- Total dépensé -->
  <div class="reveal bg-white border border-gray-100 rounded-2xl p-6 hover-lift" style="transition-delay:100ms;">
    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider mb-3">Dépensé ce mois</p>
    <p class="font-extrabold text-2xl text-ink mb-1"><?= number_format($spentThisMonth, 2, ',', ' ') ?> €</p>
    <p class="text-xs text-gray-400">€ · Statistiques mensuelles</p>
    <a href="<?= BASE_PATH ?>/mon-compte/transactions" class="inline-flex items-center gap-1 text-xs font-bold text-brand-500 hover:text-brand-600 mt-3 transition-colors">
      Voir statistiques →
    </a>
  </div>

  <!-- Points fidélité -->
  <div class="reveal bg-white border border-gray-100 rounded-2xl p-6 hover-lift" style="transition-delay:150ms;">
    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider mb-3">Fidélité</p>
    <p class="font-extrabold text-2xl text-amber-500 mb-1"><?= (int) $user['loyalty_points'] ?> ⭐</p>
    <p class="text-xs text-gray-400">Points fidélité</p>
    <a href="<?= BASE_PATH ?>/mon-compte/avantages" class="inline-flex items-center gap-1 text-xs font-bold text-brand-500 hover:text-brand-600 mt-3 transition-colors">
      Voir avantages →
    </a>
  </div>
</div>

<!-- Section recharge + autres cartes -->
<div class="grid lg:grid-cols-3 gap-6 mb-8">

  <!-- Recharge -->
  <div id="recharger" class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl p-8 scroll-mt-20">
    <h2 class="font-extrabold text-xl text-ink mb-1">Recharger mon portefeuille</h2>
    <p class="text-gray-500 text-sm mb-6">Choisissez un montant ou saisissez le vôtre.</p>

    <form method="POST" action="<?= BASE_PATH ?>/mon-compte/recharger" id="recharge-form">
      <?= Csrf::field() ?>

      <!-- Montants prédéfinis -->
      <div class="mb-6">
        <p class="text-sm font-semibold text-ink mb-3">Montant</p>
        <div class="grid grid-cols-3 sm:grid-cols-5 gap-3">
          <?php foreach ([10, 20, 50, 100, 150] as $amount): ?>
            <label class="relative cursor-pointer group">
              <input type="radio" name="amount_choice" value="<?= $amount ?>" class="peer sr-only" <?= $amount === 50 ? 'checked' : '' ?>>
              <div class="border-2 border-gray-200 peer-checked:border-brand-500 peer-checked:bg-brand-50 rounded-xl text-center py-3 px-2 font-bold text-sm transition-all group-hover:border-brand-300">
                <?= $amount ?> €
              </div>
              <?php if ($amount === 50): ?>
                <span class="absolute -top-2.5 left-1/2 -translate-x-1/2 bg-brand-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full whitespace-nowrap">Populaire</span>
              <?php endif; ?>
            </label>
          <?php endforeach; ?>
          <label class="relative cursor-pointer group">
            <input type="radio" name="amount_choice" value="autre" class="peer sr-only" id="amount-other-radio">
            <div class="border-2 border-gray-200 peer-checked:border-brand-500 peer-checked:bg-brand-50 rounded-xl text-center py-3 px-2 font-bold text-xs transition-all group-hover:border-brand-300">
              Autre
            </div>
          </label>
        </div>
      </div>

      <!-- Montant personnalisé -->
      <div id="custom-amount-wrapper" class="hidden mb-6">
        <input type="number" name="custom_amount" min="5" max="500" step="1" 
               placeholder="Montant (5 à 500 €)"
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30 focus:border-brand-500 transition-all">
      </div>

      <!-- Bonus -->
      <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
        <p class="text-sm font-semibold text-emerald-600 flex items-center gap-2">
          🎁 <span id="bonus-hint">Bonus : +2 € offerts pour une recharge de 50 €</span>
        </p>
      </div>

      <!-- Mode de paiement -->
      <div class="mb-6">
        <p class="text-sm font-semibold text-ink mb-3">Mode de paiement</p>
        <div class="grid grid-cols-2 gap-3">
          <label class="relative cursor-pointer group">
            <input type="radio" name="payment_method" value="carte_bancaire" class="peer sr-only" checked>
            <div class="border-2 border-gray-200 peer-checked:border-brand-500 peer-checked:bg-brand-50 rounded-xl px-4 py-3 flex items-center gap-2 text-sm font-semibold text-ink transition-all group-hover:border-brand-300">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M2 10h20"/></svg>
              Carte
            </div>
          </label>
          <label class="relative cursor-pointer group">
            <input type="radio" name="payment_method" value="apple_pay" class="peer sr-only">
            <div class="border-2 border-gray-200 peer-checked:border-brand-500 peer-checked:bg-brand-50 rounded-xl px-4 py-3 flex items-center gap-2 text-sm font-semibold text-ink transition-all group-hover:border-brand-300">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17 2a5 5 0 00-4 2 4.5 4.5 0 00-1 3 4 4 0 003.5-2A5 5 0 0017 2zm-4.5 6.5c-1.2 0-2.6.9-3.5.9s-2-.9-3.4-.9C3.6 8.5 2 10.2 2 13c0 3.3 2.4 8 4.3 8 1 0 1.5-.7 2.7-.7s1.7.7 2.7.7c1.9 0 4.3-4.5 4.3-8-.1-3-2-4.5-3.5-4.5z"/></svg>
              Pay
            </div>
          </label>
        </div>
      </div>

      <!-- Bouton soumettre -->
      <button type="submit" class="w-full bg-gradient-to-r from-brand-500 to-brand-600 hover:from-brand-600 hover:to-brand-700 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg hover:shadow-xl">
        Recharger mon portefeuille
      </button>
    </form>
  </div>

  <!-- Card promotionnelle -->
  <div class="bg-white border border-gray-100 rounded-2xl p-6 flex flex-col">
    <h3 class="font-bold text-ink mb-3">💡 Conseil</h3>
    <p class="text-sm text-gray-600 flex-1">Rechargez votre portefeuille une seule fois pour accumuler les points fidélité et profiter de réductions exclusives.</p>
    <a href="<?= BASE_PATH ?>/mon-compte/avantages" class="mt-4 inline-flex items-center gap-2 text-xs font-bold text-brand-500 hover:text-brand-600 transition-colors">
      Découvrir les avantages →
    </a>
  </div>

</div>

<!-- Actions rapides -->
<div class="grid sm:grid-cols-2 gap-4 mb-8">
  <a href="<?= BASE_PATH ?>/mon-compte/offres" class="bg-white border border-gray-100 rounded-xl p-4 hover:border-brand-300 transition-all hover-lift">
    <p class="font-bold text-ink flex items-center gap-2 mb-1">
      <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v-1m0 0H9m3 0h3m-3 4h12a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8a2 2 0 012-2z"/></svg>
      Mes offres
    </p>
    <p class="text-xs text-gray-500">Consultez vos codes promotionnels</p>
  </a>
  <a href="<?= BASE_PATH ?>/mon-compte/sondages" class="bg-white border border-gray-100 rounded-xl p-4 hover:border-brand-300 transition-all hover-lift">
    <p class="font-bold text-ink flex items-center gap-2 mb-1">
      <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14"/></svg>
      Sondages
    </p>
    <p class="text-xs text-gray-500">Participez et gagnez des points</p>
  </a>
</div>

<!-- QR + parrainage -->
<div class="grid sm:grid-cols-2 gap-6 mb-8">
    <div class="bg-white border border-gray-100 rounded-2xl p-6 text-center">
      <h2 class="font-bold text-ink mb-1">Mon QR Code client</h2>
      <p class="text-xs text-gray-400 mb-4">Montrez ce code en caisse pour accéder à votre portefeuille.</p>
      <div class="bg-white border border-gray-200 rounded-xl p-3 inline-block">
        <svg viewBox="0 0 100 100" class="w-32 h-32">
          <rect width="100" height="100" fill="#fff"/>
          <?php
            mt_srand(crc32($wallet['qr_code']));
            for ($y = 0; $y < 14; $y++) {
                for ($x = 0; $x < 14; $x++) {
                    if (mt_rand(0, 100) > 52) {
                        echo '<rect x="' . (6 + $x * 6) . '" y="' . (6 + $y * 6) . '" width="6" height="6" fill="#111"/>';
                    }
                }
            }
          ?>
          <rect x="6" y="6" width="18" height="18" fill="none" stroke="#111" stroke-width="4"/>
          <rect x="76" y="6" width="18" height="18" fill="none" stroke="#111" stroke-width="4"/>
          <rect x="6" y="76" width="18" height="18" fill="none" stroke="#111" stroke-width="4"/>
        </svg>
      </div>
      <p class="text-xs text-gray-400 mt-3 font-mono"><?= htmlspecialchars($wallet['qr_code']) ?></p>
    </div>

    <div class="bg-ink rounded-2xl p-6 text-white">
      <h2 class="font-bold mb-1">Parrainez vos amis !</h2>
      <p class="text-gray-400 text-sm mb-4">Gagnez 10 € de crédit pour chaque ami qui s'inscrit et effectue sa première recharge.</p>
      <p class="text-xs text-gray-500 mb-4"><?= $referralCount ?> filleul<?= $referralCount > 1 ? 's' : '' ?> pour le moment</p>
      <a href="<?= BASE_PATH ?>/mon-compte/parrainage" class="block text-center bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm px-4 py-3 rounded-lg transition-colors">
        Parrainer un ami
      </a>
    </div>
</div>

<!-- Comment ça marche -->
<div class="bg-white border border-gray-100 rounded-2xl p-6">
  <h2 class="font-bold text-ink mb-5">Comment ça marche ?</h2>
  <div class="grid sm:grid-cols-4 gap-6">
    <?php
      $steps = [
          ['1', 'Rechargez votre compte', 'Ajoutez du crédit à votre compte en ligne ou directement au bar.'],
          ['2', 'Scannez votre QR Code', 'Présentez votre QR Code en caisse pour accéder à votre portefeuille.'],
          ['3', 'Payez en toute simplicité', 'Le montant de votre consommation est déduit automatiquement.'],
          ['4', 'Suivez vos dépenses', 'Consultez vos transactions et votre solde à tout moment.'],
      ];
    ?>
    <?php foreach ($steps as [$num, $title, $desc]): ?>
      <div>
        <span class="w-8 h-8 rounded-full bg-ink text-white flex items-center justify-center font-bold text-sm mb-3"><?= $num ?></span>
        <p class="font-semibold text-ink text-sm mb-1"><?= htmlspecialchars($title) ?></p>
        <p class="text-xs text-gray-500 leading-relaxed"><?= htmlspecialchars($desc) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<script>
  document.querySelectorAll('input[name="amount_choice"]').forEach((radio) => {
    radio.addEventListener('change', () => {
      const wrapper = document.getElementById('custom-amount-wrapper');
      const isOther = document.getElementById('amount-other-radio').checked;
      wrapper.classList.toggle('hidden', !isOther);
      document.querySelector('input[name="custom_amount"]').required = isOther;
    });
  });
</script>
