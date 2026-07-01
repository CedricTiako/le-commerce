<?php use App\Core\Csrf; ?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
  <p class="text-sm text-gray-500">Fidélisez vos clients en leur offrant des avantages, réductions, produits...</p>
  <div class="flex gap-2">
    <a href="<?= BASE_PATH ?>/admin/offres/scanner" class="inline-flex items-center gap-2 border-2 border-ink text-ink hover:bg-ink hover:text-white font-bold text-sm px-5 py-3 rounded-xl transition-colors">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h4V2H2v6h2V4zm16 0v4h2V2h-6v2h4zM4 20h4v2H2v-6h2v4zm16 0h-4v2h6v-6h-2v4zM8 8h8v8H8V8z"/></svg>
      Scanner une offre
    </a>
    <a href="<?= BASE_PATH ?>/admin/offres/creer" class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm px-5 py-3 rounded-xl transition-colors">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
      Créer une nouvelle offre
    </a>
  </div>
</div>

<!-- KPIs -->
<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <p class="text-sm font-semibold text-gray-500 mb-2">Offres actives</p>
    <p class="font-extrabold text-3xl text-ink"><?= $offersActive ?></p>
    <p class="text-xs font-semibold text-emerald-500 mt-1">+<?= $offersDelta ?> ce mois-ci</p>
  </div>
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <p class="text-sm font-semibold text-gray-500 mb-2">Utilisations ce mois</p>
    <p class="font-extrabold text-3xl text-ink"><?= $usagesThisMonth ?></p>
  </div>
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <p class="text-sm font-semibold text-gray-500 mb-2">Clients touchés</p>
    <p class="font-extrabold text-3xl text-ink"><?= $clientsTouched ?></p>
  </div>
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <p class="text-sm font-semibold text-gray-500 mb-2">Économies offertes</p>
    <p class="font-extrabold text-3xl text-ink"><?= number_format($savings, 2, ',', ' ') ?> €</p>
  </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">

  <!-- Liste des offres -->
  <div class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl overflow-hidden">
    <div class="flex items-center gap-1 px-5 pt-4 border-b border-gray-50 overflow-x-auto">
      <?php
        $tabs = ['active' => 'Mes offres actives', 'brouillons' => 'Brouillons', 'expirees' => 'Offres expirées', 'toutes' => 'Toutes les offres'];
      ?>
      <?php foreach ($tabs as $key => $label): ?>
        <a href="<?= BASE_PATH ?>/admin/offres?statut=<?= $key ?>"
           class="px-4 py-3 text-sm font-semibold border-b-2 -mb-px whitespace-nowrap transition-colors
                  <?= $activeTab === $key ? 'border-brand-500 text-brand-500' : 'border-transparent text-gray-400 hover:text-ink' ?>">
          <?= htmlspecialchars($label) ?>
        </a>
      <?php endforeach; ?>
    </div>

    <?php if (empty($offers)): ?>
      <div class="text-center py-16 px-6">
        <p class="text-gray-500 font-medium mb-1">Aucune offre dans cette catégorie.</p>
        <a href="<?= BASE_PATH ?>/admin/offres/creer" class="text-brand-500 text-sm font-semibold hover:underline">Créer votre première offre</a>
      </div>
    <?php else: ?>
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead class="bg-gray-50">
            <tr class="text-left text-gray-500 text-xs uppercase tracking-wide">
              <th class="px-5 py-3 font-semibold">Offre</th>
              <th class="px-5 py-3 font-semibold">Type</th>
              <th class="px-5 py-3 font-semibold">Cible</th>
              <th class="px-5 py-3 font-semibold">Utilisations</th>
              <th class="px-5 py-3 font-semibold">Validité</th>
              <th class="px-5 py-3 font-semibold">Statut</th>
              <th class="px-5 py-3 font-semibold text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-50">
            <?php foreach ($offers as $offer): ?>
              <?php $isExpired = strtotime($offer['valid_until']) < strtotime('today'); ?>
              <tr class="hover:bg-gray-50/50">
                <td class="px-5 py-3.5">
                  <p class="font-semibold text-ink"><?= htmlspecialchars($offer['title']) ?></p>
                  <?php if ($offer['description']): ?>
                    <p class="text-xs text-gray-400 max-w-[220px] truncate"><?= htmlspecialchars($offer['description']) ?></p>
                  <?php endif; ?>
                </td>
                <td class="px-5 py-3.5 text-gray-600"><?= htmlspecialchars($typeLabels[$offer['type']] ?? $offer['type']) ?></td>
                <td class="px-5 py-3.5 text-gray-600"><?= htmlspecialchars($segmentLabels[$offer['target_segment']] ?? $offer['target_segment']) ?></td>
                <td class="px-5 py-3.5 font-semibold text-ink"><?= $offer['usage_count'] ?></td>
                <td class="px-5 py-3.5 text-gray-500"><?= date('d/m/Y', strtotime($offer['valid_until'])) ?></td>
                <td class="px-5 py-3.5">
                  <?php if ($isExpired): ?>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-gray-100 text-gray-500">Expirée</span>
                  <?php elseif ($offer['status'] === 'active'): ?>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600">Active</span>
                  <?php else: ?>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-amber-50 text-amber-600">Brouillon</span>
                  <?php endif; ?>
                </td>
                <td class="px-5 py-3.5 text-right">
                  <?php if (!$isExpired): ?>
                    <form method="POST" action="<?= BASE_PATH ?>/admin/offres/<?= $offer['id'] ?>/statut" class="inline">
                      <?= Csrf::field() ?>
                      <button type="submit" class="text-xs font-bold text-gray-500 hover:text-brand-500">
                        <?= $offer['status'] === 'active' ? 'Passer en brouillon' : 'Activer' ?>
                      </button>
                    </form>
                  <?php else: ?>
                    <span class="text-xs text-gray-300">—</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>

  <!-- Panneaux d'action -->
  <div class="flex flex-col gap-6">

    <!-- Générer un code -->
    <div class="bg-white border border-gray-100 rounded-2xl p-6">
      <h2 class="font-bold text-ink mb-1">Générer un code / QR pour un client</h2>
      <p class="text-xs text-gray-400 mb-4">Créez un code unique à remettre en main propre.</p>
      <form method="POST" action="<?= BASE_PATH ?>/admin/offres/generer" class="space-y-3">
        <?= Csrf::field() ?>
        <select name="user_id" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30">
          <option value="">Sélectionner un client</option>
          <?php foreach ($clients as $c): ?>
            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['first_name'] . ' ' . $c['last_name']) ?> — <?= htmlspecialchars($c['phone_whatsapp']) ?></option>
          <?php endforeach; ?>
        </select>
        <select name="offer_id" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30">
          <option value="">Sélectionner une offre</option>
          <?php foreach ($activeOffers as $o): ?>
            <option value="<?= $o['id'] ?>"><?= htmlspecialchars($o['title']) ?></option>
          <?php endforeach; ?>
        </select>
        <button type="submit" class="w-full bg-ink hover:bg-black text-white font-bold text-sm px-5 py-3 rounded-lg transition-colors">
          Générer un code
        </button>
      </form>
    </div>

    <!-- Envoyer une offre -->
    <div class="bg-white border border-gray-100 rounded-2xl p-6">
      <h2 class="font-bold text-ink mb-1">Envoyer une offre à un client</h2>
      <p class="text-xs text-gray-400 mb-4">Envoyez directement l'offre et son code par WhatsApp.</p>
      <form method="POST" action="<?= BASE_PATH ?>/admin/offres/envoyer" class="space-y-3">
        <?= Csrf::field() ?>
        <select name="user_id" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30">
          <option value="">Sélectionner un client</option>
          <?php foreach ($clients as $c): ?>
            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['first_name'] . ' ' . $c['last_name']) ?></option>
          <?php endforeach; ?>
        </select>
        <select name="offer_id" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30">
          <option value="">Sélectionner une offre</option>
          <?php foreach ($activeOffers as $o): ?>
            <option value="<?= $o['id'] ?>"><?= htmlspecialchars($o['title']) ?></option>
          <?php endforeach; ?>
        </select>
        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm px-5 py-3 rounded-lg transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.4A10 10 0 1 0 12 2z"/></svg>
          Envoyer sur WhatsApp
        </button>
      </form>
    </div>
  </div>
</div>
