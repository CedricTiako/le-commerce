<div class="space-y-6">
  <div class="grid gap-6 xl:grid-cols-[1.6fr_1fr]">
    <section class="card card-md">
      <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
        <div>
          <span class="inline-flex items-center gap-2 rounded-full bg-brand-50 px-3 py-1 text-xs font-bold uppercase tracking-[0.25em] text-brand-600">Établissement</span>
          <h1 class="mt-4 text-4xl font-extrabold text-ink leading-tight"><?= htmlspecialchars($shop['name']) ?></h1>
          <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-500">
            Cette page présente les informations de votre commerce de proximité et les indicateurs clés qui alimentent votre modèle de fidélisation, de vente et de trafic.
          </p>
        </div>
        <div class="flex flex-col gap-3 sm:items-end">
          <a href="<?= BASE_PATH ?>/admin/parametres" class="btn-primary px-5 py-3">Modifier le commerce</a>
          <a href="<?= BASE_PATH ?>/admin/offres" class="inline-flex items-center justify-center rounded-full border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition-colors hover:bg-gray-50">Gérer les offres</a>
        </div>
      </div>

      <div class="mt-10 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
          <p class="text-sm font-semibold text-gray-500 uppercase tracking-[0.18em] mb-3">Adresse</p>
          <p class="text-sm text-ink font-semibold"><?= htmlspecialchars($shop['address']) ?></p>
          <p class="mt-1 text-sm text-gray-500"><?= htmlspecialchars($shop['zipcode'] . ' ' . $shop['city']) ?></p>
        </div>
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
          <p class="text-sm font-semibold text-gray-500 uppercase tracking-[0.18em] mb-3">Contact</p>
          <p class="text-sm text-ink font-semibold"><?= htmlspecialchars($shop['phone']) ?></p>
          <p class="mt-1 text-sm text-gray-500"><?= htmlspecialchars($shop['email']) ?></p>
        </div>
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
          <p class="text-sm font-semibold text-gray-500 uppercase tracking-[0.18em] mb-3">Horaires</p>
          <p class="text-sm text-ink font-semibold">Lun - Sam : <?= htmlspecialchars($shop['hours']['lun_sam']) ?></p>
          <p class="mt-1 text-sm text-gray-500">Dimanche : <?= htmlspecialchars($shop['hours']['dim']) ?></p>
        </div>
      </div>
    </section>

    <aside class="space-y-4">
      <div class="card card-md border-brand-100 bg-brand-50 text-brand-800">
        <p class="text-xs uppercase tracking-[0.3em] font-bold text-brand-700 mb-3">Business model</p>
        <p class="text-sm leading-6 text-brand-900">Votre commerce tire sa force de 3 leviers : fidélisation locale, offres ciblées pour les clients de passage et visibilité directe via WhatsApp et zone de proximité.</p>
      </div>

      <div class="card card-md bg-white border border-gray-100">
        <div class="flex items-center justify-between mb-4">
          <div>
            <p class="text-sm text-gray-500 uppercase tracking-[0.18em] font-semibold">Visibilité</p>
            <h2 class="text-2xl font-extrabold text-ink"><?= htmlspecialchars($shop['city']) ?></h2>
          </div>
          <span class="inline-flex items-center rounded-full bg-brand-50 px-3 py-1 text-xs font-semibold text-brand-600">Locale</span>
        </div>
        <p class="text-sm text-gray-500">Données configurées pour être visibles sur toutes les pages client et optimiser les interactions à distance.</p>
      </div>
    </aside>
  </div>

  <div class="grid gap-5 lg:grid-cols-4">
    <div class="card card-md">
      <p class="text-sm font-semibold text-gray-500 uppercase tracking-[0.18em] mb-3">Clients</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($totalClients) ?></p>
      <p class="text-xs text-gray-400 mt-2">clients inscrits</p>
    </div>
    <div class="card card-md">
      <p class="text-sm font-semibold text-gray-500 uppercase tracking-[0.18em] mb-3">Offres actives</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($activeOffers) ?></p>
      <p class="text-xs text-gray-400 mt-2">actuellement disponibles</p>
    </div>
    <div class="card card-md">
      <p class="text-sm font-semibold text-gray-500 uppercase tracking-[0.18em] mb-3">Réalisations</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($redemptionsThisMonth) ?></p>
      <p class="text-xs text-gray-400 mt-2">offres utilisées ce mois</p>
    </div>
    <div class="card card-md">
      <p class="text-sm font-semibold text-gray-500 uppercase tracking-[0.18em] mb-3">Économies</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($savingsEstimate, 2, ',', ' ') ?> €</p>
      <p class="text-xs text-gray-400 mt-2">valeur estimée</p>
    </div>
  </div>

  <div class="grid gap-6 xl:grid-cols-[1fr_0.9fr]">
    <div class="card card-md">
      <h2 class="font-bold text-ink mb-4">Résumé commercial</h2>
      <p class="text-sm leading-6 text-gray-600 mb-4">Cette page vous permet de suivre la performance de votre établissement sans sortir du back-office. Les actions en boutique, les offres et la relation client sont au cœur du modèle.</p>
      <ul class="space-y-3 text-sm text-gray-600">
        <li class="flex items-start gap-3">
          <span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-brand-500"></span>
          Clientèle fidélisée et trajectoire de consommation visible directement depuis le back-office.
        </li>
        <li class="flex items-start gap-3">
          <span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-brand-500"></span>
          Offres ciblées vers vos clients fidèles et passage occasionnel pour dynamiser la fréquentation.
        </li>
        <li class="flex items-start gap-3">
          <span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-brand-500"></span>
          Données du commerce et coordonnées centralisées pour garantir une communication claire et professionnelle.
        </li>
      </ul>
    </div>

    <div class="card card-md bg-brand-50 border-brand-100 text-brand-900">
      <h2 class="font-bold text-ink mb-4">Actions rapides</h2>
      <div class="space-y-3 text-sm leading-6">
        <div class="rounded-3xl bg-white/80 p-4">
          <p class="font-semibold text-gray-900">Mettre à jour l’adresse</p>
          <p class="text-gray-600 mt-1">Important pour les campagnes de proximité et le référencement local.</p>
        </div>
        <div class="rounded-3xl bg-white/80 p-4">
          <p class="font-semibold text-gray-900">Optimiser vos horaires</p>
          <p class="text-gray-600 mt-1">Des horaires clairs augmentent l’engagement des clients en recherche.</p>
        </div>
        <div class="rounded-3xl bg-white/80 p-4">
          <p class="font-semibold text-gray-900">Actualiser les réseaux</p>
          <p class="text-gray-600 mt-1">Le lien avec Facebook/Instagram renforce la visibilité de votre commerce.</p>
        </div>
      </div>
    </div>
  </div>
</div>
