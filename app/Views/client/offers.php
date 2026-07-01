<div class="mb-6">
  <h1 class="font-extrabold text-2xl text-ink mb-1">Mes offres</h1>
  <p class="text-gray-500 text-sm">Présentez le code ou le QR code en caisse pour profiter de vos avantages.</p>
</div>

<?php if (empty($offers)): ?>
  <div class="bg-white border border-gray-100 rounded-2xl text-center py-16 px-6">
    <span class="w-14 h-14 rounded-full bg-gray-50 text-gray-300 flex items-center justify-center mx-auto mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
    </span>
    <p class="text-gray-500 font-medium">Vous n'avez pas encore reçu d'offre.</p>
    <p class="text-gray-400 text-sm mt-1">Vos offres et avantages personnalisés apparaîtront ici.</p>
  </div>
<?php else: ?>
  <div class="grid sm:grid-cols-2 gap-5">
    <?php foreach ($offers as $offer): ?>
      <?php
        $isExpired = $offer['status'] !== 'utilisee' && strtotime($offer['valid_until']) < strtotime('today');
        $displayStatus = $isExpired ? 'expiree' : $offer['status'];
        $statusStyles = [
            'valide'   => ['bg-emerald-50 text-emerald-600', 'Valide'],
            'utilisee' => ['bg-gray-100 text-gray-500', 'Utilisée'],
            'expiree'  => ['bg-gray-100 text-gray-400', 'Expirée'],
        ];
        [$badgeClass, $badgeLabel] = $statusStyles[$displayStatus] ?? ['bg-gray-100 text-gray-500', ucfirst($displayStatus)];
      ?>
      <div class="bg-white border border-gray-100 rounded-2xl p-6 <?= $displayStatus !== 'valide' ? 'opacity-60' : '' ?>">
        <div class="flex items-start justify-between mb-3">
          <p class="font-bold text-ink"><?= htmlspecialchars($offer['offer_title']) ?></p>
          <span class="text-xs font-semibold px-2.5 py-1 rounded-full shrink-0 <?= $badgeClass ?>"><?= $badgeLabel ?></span>
        </div>
        <?php if ($offer['offer_description']): ?>
          <p class="text-sm text-gray-500 mb-4"><?= htmlspecialchars($offer['offer_description']) ?></p>
        <?php endif; ?>

        <?php if ($displayStatus === 'valide'): ?>
          <div class="bg-gray-50 rounded-xl p-4 flex items-center gap-4">
            <svg viewBox="0 0 100 100" class="w-20 h-20 shrink-0">
              <rect width="100" height="100" fill="#fff"/>
              <?php
                mt_srand(crc32($offer['code']));
                for ($y = 0; $y < 12; $y++) {
                    for ($x = 0; $x < 12; $x++) {
                        if (mt_rand(0, 100) > 52) {
                            echo '<rect x="' . (6 + $x * 7) . '" y="' . (6 + $y * 7) . '" width="7" height="7" fill="#111"/>';
                        }
                    }
                }
              ?>
            </svg>
            <div>
              <p class="text-xs text-gray-400">Code</p>
              <p class="font-mono font-bold text-ink text-lg"><?= htmlspecialchars($offer['code']) ?></p>
              <p class="text-xs text-gray-400 mt-1">Valable jusqu'au <?= date('d/m/Y', strtotime($offer['valid_until'])) ?></p>
            </div>
          </div>
        <?php else: ?>
          <p class="text-xs text-gray-400">
            <?= $displayStatus === 'utilisee' ? 'Utilisée le ' . date('d/m/Y', strtotime($offer['used_at'])) : 'Expirée le ' . date('d/m/Y', strtotime($offer['valid_until'])) ?>
          </p>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
