<?php use App\Core\Csrf; ?>

<div class="max-w-2xl">
  <a href="<?= BASE_PATH ?>/admin/offres" class="inline-flex items-center gap-1.5 text-sm font-semibold text-gray-500 hover:text-brand-500 mb-4">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    Retour aux offres
  </a>

  <div class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8">
    <h1 class="font-extrabold text-2xl text-ink mb-1">Créer une nouvelle offre</h1>
    <p class="text-gray-500 text-sm mb-6">Choisissez le type d'offre que vous souhaitez proposer à vos clients.</p>

    <form method="POST" action="<?= BASE_PATH ?>/admin/offres" class="space-y-5">
      <?= Csrf::field() ?>

      <div>
        <label class="block text-sm font-semibold text-ink mb-1.5">Nom de l'offre</label>
        <input type="text" name="title" required value="<?= htmlspecialchars($old['title'] ?? '') ?>" placeholder="Ex : Café offert"
               class="w-full border <?= isset($errors['title']) ? 'border-brand-400' : 'border-gray-200' ?> rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30 focus:border-brand-500">
        <?php if (isset($errors['title'])): ?><p class="text-brand-500 text-xs mt-1"><?= htmlspecialchars($errors['title']) ?></p><?php endif; ?>
      </div>

      <div>
        <label class="block text-sm font-semibold text-ink mb-1.5">Description</label>
        <textarea name="description" rows="2" placeholder="Ex : Un café offert pour bien commencer la journée !"
                  class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30 focus:border-brand-500"><?= htmlspecialchars($old['description'] ?? '') ?></textarea>
      </div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-semibold text-ink mb-1.5">Type d'offre</label>
          <select name="type" id="offer-type" required
                  class="w-full border <?= isset($errors['type']) ? 'border-brand-400' : 'border-gray-200' ?> rounded-lg px-3 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30">
            <option value="">Choisir un type</option>
            <?php foreach ($typeLabels as $key => $label): ?>
              <option value="<?= $key ?>" <?= ($old['type'] ?? '') === $key ? 'selected' : '' ?>><?= htmlspecialchars($label) ?></option>
            <?php endforeach; ?>
          </select>
          <?php if (isset($errors['type'])): ?><p class="text-brand-500 text-xs mt-1"><?= htmlspecialchars($errors['type']) ?></p><?php endif; ?>
        </div>

        <div>
          <label class="block text-sm font-semibold text-ink mb-1.5" id="value-label">Valeur estimée (€)</label>
          <input type="number" name="value" step="0.01" min="0" value="<?= htmlspecialchars($old['value'] ?? '') ?>" placeholder="Ex : 3.50"
                 class="w-full border <?= isset($errors['value']) ? 'border-brand-400' : 'border-gray-200' ?> rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30 focus:border-brand-500">
          <?php if (isset($errors['value'])): ?><p class="text-brand-500 text-xs mt-1"><?= htmlspecialchars($errors['value']) ?></p><?php endif; ?>
        </div>
      </div>

      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-semibold text-ink mb-1.5">Clients concernés</label>
          <select name="target_segment" required class="w-full border border-gray-200 rounded-lg px-3 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30">
            <?php foreach ($segmentLabels as $key => $label): ?>
              <option value="<?= $key ?>" <?= ($old['segment'] ?? 'tous') === $key ? 'selected' : '' ?>><?= htmlspecialchars($label) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div>
          <label class="block text-sm font-semibold text-ink mb-1.5">Valable jusqu'au</label>
          <input type="date" name="valid_until" required value="<?= htmlspecialchars($old['validUntil'] ?? '') ?>" min="<?= date('Y-m-d') ?>"
                 class="w-full border <?= isset($errors['valid_until']) ? 'border-brand-400' : 'border-gray-200' ?> rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30">
          <?php if (isset($errors['valid_until'])): ?><p class="text-brand-500 text-xs mt-1"><?= htmlspecialchars($errors['valid_until']) ?></p><?php endif; ?>
        </div>
      </div>

      <label class="flex items-center gap-2.5 text-sm text-gray-600 bg-gray-50 rounded-lg px-4 py-3">
        <input type="checkbox" name="publish" value="1" checked class="rounded border-gray-300 text-brand-500 focus:ring-brand-500/30">
        Publier immédiatement (sinon l'offre est enregistrée en brouillon)
      </label>

      <button type="submit" class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm px-6 py-3.5 rounded-lg transition-colors">
        Créer l'offre
      </button>
    </form>
  </div>
</div>

<script>
  const valueLabels = {
    'reduction_pourcentage': 'Pourcentage de réduction (%)',
    'gratuite': 'Valeur estimée offerte (€)',
    'x_plus_1': 'Valeur du produit offert (€)',
    'montant_minimum': 'Montant minimum d\'achat (€)',
    'personnalisee': 'Valeur estimée (€)',
  };
  document.getElementById('offer-type').addEventListener('change', (e) => {
    document.getElementById('value-label').textContent = valueLabels[e.target.value] || 'Valeur estimée (€)';
  });
</script>
