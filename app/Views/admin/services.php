<div class="space-y-6">
  <?php
  $pageTitle = 'Services du quotidien';
  $pageSubtitle = 'Suivez l’état des offres et campagnes de service qui dynamisent votre commerce de proximité.';
  $pageActions = [
    ['href' => BASE_PATH . '/admin/offres', 'label' => 'Voir les offres', 'class' => 'btn-primary'],
  ];
  require __DIR__ . '/../partials/admin-page-header.php';
  ?>

  <div class="grid gap-5 lg:grid-cols-4">
    <div class="card card-md">
      <p class="text-xs uppercase tracking-[0.2em] text-gray-500 font-semibold mb-3">Offres actives</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($activeOffers) ?></p>
      <p class="text-xs text-gray-400 mt-2">Offres en boutique disponibles dès maintenant</p>
    </div>
    <div class="card card-md">
      <p class="text-xs uppercase tracking-[0.2em] text-gray-500 font-semibold mb-3">Nouvelles offres</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($newOffers) ?></p>
      <p class="text-xs text-gray-400 mt-2">Créées ce mois-ci</p>
    </div>
    <div class="card card-md">
      <p class="text-xs uppercase tracking-[0.2em] text-gray-500 font-semibold mb-3">Campagnes actives</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($activeCampaigns) ?></p>
      <p class="text-xs text-gray-400 mt-2">Campagnes de proximité envoyées aux clients</p>
    </div>
    <div class="card card-md">
      <p class="text-xs uppercase tracking-[0.2em] text-gray-500 font-semibold mb-3">Clients</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($totalClients) ?></p>
      <p class="text-xs text-gray-400 mt-2">Clients actifs dans votre base</p>
    </div>
  </div>

  <div class="grid gap-6 lg:grid-cols-[1.3fr_0.7fr]">
    <div class="card card-md">
      <div class="flex items-center justify-between mb-4">
        <div>
          <p class="text-sm font-semibold text-gray-500 uppercase tracking-[0.18em]">Offres actives</p>
          <h2 class="text-xl font-bold text-ink">Usage et performance</h2>
        </div>
        <a href="<?= BASE_PATH ?>/admin/offres" class="text-sm font-semibold text-brand-500 hover:underline">Gérer les offres</a>
      </div>

      <?php if (empty($activeOffersList)): ?>
        <p class="text-sm text-gray-400 py-8 text-center">Aucune offre active disponible pour le moment.</p>
      <?php else: ?>
        <div class="space-y-3">
          <?php foreach ($activeOffersList as $offer): ?>
            <div class="rounded-3xl border border-gray-100 bg-white p-4 shadow-sm">
              <div class="flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center">
                <div>
                  <p class="font-semibold text-ink"><?= htmlspecialchars($offer['title']) ?></p>
                  <p class="text-sm text-gray-500"><?= htmlspecialchars($offer['description'] ?? 'Pas de description') ?></p>
                </div>
                <span class="inline-flex items-center rounded-full bg-brand-50 px-3 py-1 text-xs font-semibold text-brand-700">Utilisations : <?= (int) $offer['usage_count'] ?></span>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="card card-md bg-brand-50 border-brand-100 text-brand-800">
      <h2 class="font-bold text-ink mb-4">Pilotez vos services</h2>
      <p class="text-sm leading-6">Votre modèle business repose sur l’activation rapide des offres en boutique et l’envoi de campagnes géolocalisées. C’est ici que vous validez le niveau de disponibilité et l’impact client.</p>
      <div class="mt-6 space-y-3 text-sm text-brand-900/90">
        <div class="rounded-3xl bg-white/80 p-4">
          <p class="font-semibold">Actions prioritaires</p>
          <ul class="list-disc pl-5 mt-2 space-y-1">
            <li>Actualiser les offres en promotion</li>
            <li>Vérifier les campagnes actives</li>
            <li>Suivre le taux de conversion par offre</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
