<?php use App\Core\Csrf; ?>

<div class="mb-6">
  <h1 class="font-extrabold text-2xl text-ink mb-1">Bienvenue <?= htmlspecialchars($user['first_name']) ?> 👋</h1>
  <p class="text-gray-500 text-sm">Voici un aperçu de votre compte et de vos activités au Commerce.</p>
</div>

<!-- KPIs -->
<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">

  <div class="bg-emerald-500 rounded-2xl p-6 text-white">
    <div class="flex items-center gap-2 mb-2 text-emerald-100 text-sm font-semibold">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2"/></svg>
      Mon portefeuille
    </div>
    <p class="font-extrabold text-3xl mb-4"><?= number_format($wallet['balance'], 2, ',', ' ') ?> €</p>
    <a href="#recharger" class="inline-flex items-center justify-center w-full bg-white text-emerald-600 font-bold text-sm px-4 py-2.5 rounded-lg hover:bg-emerald-50 transition-colors">
      Recharger mon portefeuille
    </a>
  </div>

  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <p class="text-sm font-semibold text-gray-500 mb-2">Dernière transaction</p>
    <?php if ($lastTransaction): ?>
      <p class="font-extrabold text-2xl <?= $lastTransaction['type'] === 'debit' ? 'text-brand-500' : 'text-emerald-500' ?>">
        <?= $lastTransaction['type'] === 'debit' ? '-' : '+' ?><?= number_format($lastTransaction['amount'], 2, ',', ' ') ?> €
      </p>
      <p class="text-xs text-gray-400 mt-1"><?= htmlspecialchars($lastTransaction['label'] ?? ucfirst($lastTransaction['type'])) ?> · <?= date('d/m/Y à H:i', strtotime($lastTransaction['created_at'])) ?></p>
    <?php else: ?>
      <p class="text-gray-400 text-sm mt-2">Aucune transaction pour le moment</p>
    <?php endif; ?>
    <a href="<?= BASE_PATH ?>/mon-compte/transactions" class="text-xs font-semibold text-brand-500 hover:underline mt-3 inline-block">Voir toutes mes transactions</a>
  </div>

  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <p class="text-sm font-semibold text-gray-500 mb-2">Total dépensé ce mois</p>
    <p class="font-extrabold text-2xl text-ink"><?= number_format($spentThisMonth, 2, ',', ' ') ?> €</p>
    <a href="<?= BASE_PATH ?>/mon-compte/transactions" class="text-xs font-semibold text-brand-500 hover:underline mt-3 inline-block">Voir mes statistiques</a>
  </div>

  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <p class="text-sm font-semibold text-gray-500 mb-2">Mes avantages</p>
    <p class="font-extrabold text-2xl text-ink"><?= (int) $user['loyalty_points'] ?> points</p>
    <a href="<?= BASE_PATH ?>/mon-compte/avantages" class="text-xs font-semibold text-brand-500 hover:underline mt-3 inline-block">Voir mes avantages</a>
  </div>
</div>

<div class="grid lg:grid-cols-3 gap-6 mb-6">

  <!-- Recharge -->
  <div id="recharger" class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl p-6 scroll-mt-6">
    <h2 class="font-bold text-ink mb-1">Recharger mon portefeuille</h2>
    <p class="text-sm text-gray-500 mb-5">Choisissez un montant ou saisissez le vôtre.</p>

    <form method="POST" action="<?= BASE_PATH ?>/mon-compte/recharger" id="recharge-form">
      <?= Csrf::field() ?>

      <div class="grid grid-cols-3 sm:grid-cols-6 gap-2 mb-4">
        <?php foreach ([10, 20, 50, 100, 150] as $amount): ?>
          <label class="relative cursor-pointer">
            <input type="radio" name="amount_choice" value="<?= $amount ?>" class="peer sr-only" <?= $amount === 50 ? 'checked' : '' ?>>
            <div class="border-2 border-gray-200 peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-600 rounded-lg text-center py-3 font-bold text-sm transition-colors">
              <?= $amount ?> €
            </div>
            <?php if ($amount === 50): ?>
              <span class="absolute -top-2 left-1/2 -translate-x-1/2 bg-brand-500 text-white text-[9px] font-bold px-2 py-0.5 rounded-full whitespace-nowrap">Populaire</span>
            <?php endif; ?>
          </label>
        <?php endforeach; ?>
        <label class="relative cursor-pointer">
          <input type="radio" name="amount_choice" value="autre" class="peer sr-only" id="amount-other-radio">
          <div class="border-2 border-gray-200 peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-600 rounded-lg text-center py-3 font-bold text-xs transition-colors">
            Autre montant
          </div>
        </label>
      </div>

      <div id="custom-amount-wrapper" class="hidden mb-4">
        <input type="number" name="custom_amount" min="5" max="500" step="1" placeholder="Montant en euros (5 à 500 €)"
               class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30 focus:border-brand-500">
      </div>

      <p class="text-xs text-emerald-600 font-semibold mb-5 flex items-center gap-1.5" id="bonus-hint">
        🎁 Bonus : +2 € offerts pour une recharge de 50 €
      </p>

      <p class="text-sm font-semibold text-ink mb-2">Mode de paiement</p>
      <div class="grid grid-cols-2 gap-3 mb-5">
        <label class="relative cursor-pointer">
          <input type="radio" name="payment_method" value="carte_bancaire" class="peer sr-only" checked>
          <div class="border-2 border-gray-200 peer-checked:border-brand-500 peer-checked:bg-brand-50 rounded-lg px-4 py-3 flex items-center gap-2 text-sm font-semibold text-ink transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path stroke-linecap="round" d="M2 10h20"/></svg>
            Carte bancaire
          </div>
        </label>
        <label class="relative cursor-pointer">
          <input type="radio" name="payment_method" value="apple_pay" class="peer sr-only">
          <div class="border-2 border-gray-200 peer-checked:border-brand-500 peer-checked:bg-brand-50 rounded-lg px-4 py-3 flex items-center gap-2 text-sm font-semibold text-ink transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17 2a5 5 0 00-4 2 4.5 4.5 0 00-1 3 4 4 0 003.5-2A5 5 0 0017 2zm-4.5 6.5c-1.2 0-2.6.9-3.5.9s-2-.9-3.4-.9C3.6 8.5 2 10.2 2 13c0 3.3 2.4 8 4.3 8 1 0 1.5-.7 2.7-.7s1.7.7 2.7.7c1.9 0 4.3-4.5 4.3-8-.1-3-2-4.5-3.5-4.5z"/></svg>
            Apple / Google Pay
          </div>
        </label>
      </div>

      <button type="submit" class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm px-6 py-3.5 rounded-lg transition-colors">
        Continuer le paiement
      </button>
      <p class="text-xs text-gray-400 text-center mt-3">🔒 Paiement 100 % sécurisé, sans frais cachés.</p>
    </form>
  </div>

  <!-- QR + parrainage -->
  <div class="flex flex-col gap-6">
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
