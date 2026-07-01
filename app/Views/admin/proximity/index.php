<?php use App\Core\Csrf; ?>

<p class="text-sm text-gray-500 mb-6">Touchez les clients à proximité de votre établissement avec des offres au bon moment.</p>

<!-- KPIs -->
<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
  <div class="card card-md">
    <p class="text-sm font-semibold text-gray-500 mb-2">Campagnes actives</p>
    <p class="font-extrabold text-3xl text-ink"><?= $campaignsActive ?></p>
  </div>
  <div class="card card-md">
    <p class="text-sm font-semibold text-gray-500 mb-2">Offres envoyées</p>
    <p class="font-extrabold text-3xl text-ink"><?= $totalSent ?></p>
  </div>
  <div class="card card-md">
    <p class="text-sm font-semibold text-gray-500 mb-2">Offres utilisées</p>
    <p class="font-extrabold text-3xl text-ink"><?= $totalUsed ?></p>
  </div>
  <div class="card card-md">
    <p class="text-sm font-semibold text-gray-500 mb-2">Taux de conversion</p>
    <p class="font-extrabold text-3xl text-ink"><?= $totalSent > 0 ? round(($totalUsed / $totalSent) * 100, 1) : 0 ?>%</p>
  </div>
</div>

<div class="grid lg:grid-cols-3 gap-6 mb-6">

  <!-- Formulaire de création -->
  <div class="lg:col-span-2 card card-md">
    <h2 class="section-title mb-1">Créer une campagne de proximité</h2>
    <p class="text-sm text-gray-500 mb-5">Le client recevra votre offre lorsqu'il entrera dans la zone définie, pendant la plage horaire choisie.</p>

    <form method="POST" action="<?= BASE_PATH ?>/admin/zonage" class="space-y-4">
      <?= Csrf::field() ?>

      <div>
        <label class="block text-sm font-semibold text-ink mb-1.5">Nom de la campagne</label>
        <input type="text" name="name" required placeholder="Ex : Café du matin"
               class="form-input">
      </div>

      <div>
        <label class="block text-sm font-semibold text-ink mb-1.5">
          Zone de diffusion : <span id="radius-value" class="text-brand-500">500 mètres</span>
        </label>
        <input type="range" name="radius_m" min="100" max="5000" step="100" value="500" id="radius-slider"
               class="w-full accent-brand-500">
        <div class="flex justify-between text-[10px] text-gray-400 mt-1">
          <span>100m</span><span>1km</span><span>2km</span><span>5km</span>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-semibold text-ink mb-1.5">Heure de début</label>
          <input type="time" name="start_time" required value="10:00"
                 class="form-input">
        </div>
        <div>
          <label class="block text-sm font-semibold text-ink mb-1.5">Heure de fin</label>
          <input type="time" name="end_time" required value="11:00"
                 class="form-input">
        </div>
      </div>

      <div>
        <label class="block text-sm font-semibold text-ink mb-2">Jours de diffusion</label>
        <div class="flex flex-wrap gap-2">
          <?php foreach (['lun' => 'Lun', 'mar' => 'Mar', 'mer' => 'Mer', 'jeu' => 'Jeu', 'ven' => 'Ven', 'sam' => 'Sam', 'dim' => 'Dim'] as $key => $label): ?>
            <label class="cursor-pointer">
              <input type="checkbox" name="days[]" value="<?= $key ?>" class="peer sr-only" <?= in_array($key, ['lun', 'mar', 'mer', 'jeu', 'ven'], true) ? 'checked' : '' ?>>
              <span class="inline-block px-3 py-2 rounded-lg text-xs font-bold border-2 border-gray-200 peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-600 transition-colors">
                <?= $label ?>
              </span>
            </label>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-semibold text-ink mb-1.5">Cible</label>
          <select name="target_segment" class="form-select">
            <?php foreach ($segmentLabels as $key => $label): ?>
              <option value="<?= $key ?>"><?= htmlspecialchars($label) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div>
          <label class="block text-sm font-semibold text-ink mb-1.5">Offre liée <span class="text-gray-400 font-normal">(facultatif)</span></label>
          <select name="offer_id" class="form-select">
            <option value="">Aucune offre</option>
            <?php foreach ($activeOffers as $o): ?>
              <option value="<?= $o['id'] ?>"><?= htmlspecialchars($o['title']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div>
        <label class="block text-sm font-semibold text-ink mb-1.5">Message</label>
        <textarea name="message" rows="3" maxlength="160" required placeholder="👋 Bonjour {prenom} ! Vous n'êtes pas loin du Commerce..."
                  class="form-textarea"></textarea>
      </div>

      <label class="flex items-center gap-2.5 text-sm text-gray-600 bg-gray-50 rounded-2xl px-4 py-3">
        <input type="checkbox" name="publish" value="1" checked class="rounded border-gray-300 text-brand-500 focus:ring-brand-500/30">
        Activer immédiatement la campagne
      </label>

      <button type="submit" class="btn-primary w-full">
        Lancer la campagne
      </button>
    </form>
  </div>

  <!-- Carte -->
  <div class="flex flex-col gap-6">
    <div class="card card-md p-4">
      <p class="font-bold text-ink text-sm mb-3 px-2">Zone de diffusion</p>
      <div id="proximity-map" class="w-full h-[280px] rounded-xl overflow-hidden bg-gray-100"></div>
      <p class="text-[11px] text-gray-400 mt-2 px-2">La carte se met à jour selon le rayon choisi ci-contre.</p>
    </div>

    <div class="card card-md bg-brand-50 border-brand-100 text-brand-700">
      <p class="font-bold mb-1">Respect de la vie privée</p>
      <ul class="space-y-1 list-disc list-inside">
        <li>Le client doit avoir accepté la géolocalisation à l'inscription.</li>
        <li>Aucune position n'est stockée : seule la distance instantanée est calculée.</li>
        <li>Le client peut désactiver cette option à tout moment.</li>
      </ul>
    </div>
  </div>
</div>

<!-- Liste des campagnes -->
<div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
  <div class="px-5 py-4 border-b border-gray-50">
    <h2 class="font-bold text-ink">Campagnes</h2>
  </div>
  <?php if (empty($campaigns)): ?>
    <div class="text-center py-16 px-6">
      <p class="text-gray-500 font-medium">Aucune campagne créée pour le moment.</p>
    </div>
  <?php else: ?>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-gray-50">
          <tr class="text-left text-gray-500 text-xs uppercase tracking-wide">
            <th class="px-5 py-3 font-semibold">Campagne</th>
            <th class="px-5 py-3 font-semibold">Zone</th>
            <th class="px-5 py-3 font-semibold">Période</th>
            <th class="px-5 py-3 font-semibold">Cible</th>
            <th class="px-5 py-3 font-semibold">Envoyées</th>
            <th class="px-5 py-3 font-semibold">Utilisées</th>
            <th class="px-5 py-3 font-semibold">Statut</th>
            <th class="px-5 py-3 font-semibold text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
          <?php foreach ($campaigns as $c): ?>
            <?php $dayLabels = ['lun'=>'Lun','mar'=>'Mar','mer'=>'Mer','jeu'=>'Jeu','ven'=>'Ven','sam'=>'Sam','dim'=>'Dim']; ?>
            <tr class="hover:bg-gray-50/50">
              <td class="px-5 py-3.5">
                <p class="font-semibold text-ink"><?= htmlspecialchars($c['name']) ?></p>
                <?php if ($c['offer_title']): ?><p class="text-xs text-gray-400"><?= htmlspecialchars($c['offer_title']) ?></p><?php endif; ?>
              </td>
              <td class="px-5 py-3.5 text-gray-600"><?= $c['radius_m'] >= 1000 ? number_format($c['radius_m'] / 1000, 1) . ' km' : $c['radius_m'] . ' m' ?></td>
              <td class="px-5 py-3.5 text-gray-600">
                <?= substr($c['start_time'], 0, 5) ?> - <?= substr($c['end_time'], 0, 5) ?>
                <br><span class="text-xs text-gray-400"><?= implode(', ', array_map(fn($d) => $dayLabels[$d] ?? $d, explode(',', $c['days']))) ?></span>
              </td>
              <td class="px-5 py-3.5 text-gray-600"><?= htmlspecialchars($segmentLabels[$c['target_segment']] ?? $c['target_segment']) ?></td>
              <td class="px-5 py-3.5 font-semibold text-ink"><?= $c['sent_count'] ?></td>
              <td class="px-5 py-3.5 font-semibold text-ink"><?= $c['used_count'] ?></td>
              <td class="px-5 py-3.5">
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full <?= $c['status'] === 'active' ? 'bg-emerald-50 text-emerald-600' : 'bg-gray-100 text-gray-500' ?>">
                  <?= $c['status'] === 'active' ? 'Active' : 'En pause' ?>
                </span>
              </td>
              <td class="px-5 py-3.5 text-right">
                <form method="POST" action="<?= BASE_PATH ?>/admin/zonage/<?= $c['id'] ?>/statut">
                  <?= Csrf::field() ?>
                  <button type="submit" class="text-xs font-bold text-gray-400 hover:text-brand-500">
                    <?= $c['status'] === 'active' ? 'Mettre en pause' : 'Activer' ?>
                  </button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<!-- Leaflet (carte interactive, nécessite un accès Internet réel côté navigateur) -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  (function () {
    if (typeof L === 'undefined') return; // pas de connexion : on n'affiche pas de carte cassée
    const shopLat = <?= $shopLat ?>;
    const shopLng = <?= $shopLng ?>;

    const map = L.map('proximity-map', { zoomControl: false, dragging: false, scrollWheelZoom: false }).setView([shopLat, shopLng], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap',
    }).addTo(map);

    L.marker([shopLat, shopLng]).addTo(map);
    let circle = L.circle([shopLat, shopLng], { radius: 500, color: '#c8102e', fillColor: '#c8102e', fillOpacity: 0.15 }).addTo(map);

    const slider = document.getElementById('radius-slider');
    const valueLabel = document.getElementById('radius-value');
    slider.addEventListener('input', () => {
      const r = parseInt(slider.value, 10);
      circle.setRadius(r);
      valueLabel.textContent = r >= 1000 ? (r / 1000).toFixed(1) + ' km' : r + ' m';
      map.fitBounds(circle.getBounds());
    });
  })();
</script>
