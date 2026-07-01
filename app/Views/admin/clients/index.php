<?php use App\Core\Csrf; ?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
  <div>
    <p class="text-sm text-gray-500">Retrouvez vos clients inscrits et communiquez facilement avec eux.</p>
  </div>
  <div class="flex items-center gap-3">
    <div class="bg-white border border-gray-100 rounded-xl px-4 py-2.5 flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"/></svg>
      <div>
        <p class="text-[11px] text-gray-400 leading-none">Total clients</p>
        <p class="font-bold text-ink leading-tight"><?= $totalAll ?> <span class="text-emerald-500 text-xs font-semibold">+<?= $newThisMonth ?> ce mois-ci</span></p>
      </div>
    </div>
    <a href="<?= BASE_PATH ?>/admin/clients/export?<?= http_build_query($filters) ?>"
       class="inline-flex items-center gap-2 bg-ink hover:bg-black text-white font-bold text-sm px-5 py-3 rounded-xl transition-colors">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3"/></svg>
      Exporter la liste
    </a>
  </div>
</div>

<!-- Filtres -->
<form method="GET" action="<?= BASE_PATH ?>/admin/clients" class="bg-white border border-gray-100 rounded-2xl p-4 mb-6 grid sm:grid-cols-2 lg:grid-cols-5 gap-3">
  <div class="lg:col-span-2 relative">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
    <input type="text" name="q" placeholder="Rechercher un client..." value="<?= htmlspecialchars($filters['q']) ?>"
           class="w-full border border-gray-200 rounded-lg pl-9 pr-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30 focus:border-brand-500">
  </div>

  <select name="status" class="border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30">
    <option value="tous"    <?= $filters['status'] === 'tous' ? 'selected' : '' ?>>Tous les statuts</option>
    <option value="actif"   <?= $filters['status'] === 'actif' ? 'selected' : '' ?>>Actif</option>
    <option value="inactif" <?= $filters['status'] === 'inactif' ? 'selected' : '' ?>>Inactif</option>
  </select>

  <select name="segment" class="border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30">
    <option value="tous"        <?= $filters['segment'] === 'tous' ? 'selected' : '' ?>>Tous les segments</option>
    <option value="nouveau"     <?= $filters['segment'] === 'nouveau' ? 'selected' : '' ?>>Nouveau</option>
    <option value="fidele"      <?= $filters['segment'] === 'fidele' ? 'selected' : '' ?>>Fidèle</option>
    <option value="occasionnel" <?= $filters['segment'] === 'occasionnel' ? 'selected' : '' ?>>Occasionnel</option>
  </select>

  <div class="flex items-center gap-2">
    <input type="date" name="from" value="<?= htmlspecialchars($filters['from']) ?>" class="w-full border border-gray-200 rounded-lg px-2 py-2.5 text-xs focus:outline-none focus:ring-2 focus:ring-brand-500/30" title="Inscrit depuis le">
    <input type="date" name="to" value="<?= htmlspecialchars($filters['to']) ?>" class="w-full border border-gray-200 rounded-lg px-2 py-2.5 text-xs focus:outline-none focus:ring-2 focus:ring-brand-500/30" title="Inscrit jusqu'au">
  </div>

  <div class="flex gap-2 lg:col-span-5 justify-end">
    <?php if ($filters['q'] || $filters['status'] !== 'tous' || $filters['segment'] !== 'tous' || $filters['from'] || $filters['to']): ?>
      <a href="<?= BASE_PATH ?>/admin/clients" class="text-sm font-semibold text-gray-500 hover:text-brand-500 px-4 py-2.5">Réinitialiser</a>
    <?php endif; ?>
    <button type="submit" class="inline-flex items-center gap-2 border-2 border-brand-500 text-brand-500 hover:bg-brand-500 hover:text-white font-bold text-sm px-5 py-2.5 rounded-lg transition-colors">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 8h12M10 12h4M11 16h2"/></svg>
      Filtrer
    </button>
  </div>
</form>

<!-- Table -->
<div class="bg-white border border-gray-100 rounded-2xl overflow-hidden">
  <?php if (empty($clients)): ?>
    <div class="text-center py-16 px-6">
      <p class="text-gray-500 font-medium mb-1">Aucun client ne correspond à ces critères.</p>
      <p class="text-gray-400 text-sm">Essayez d'élargir votre recherche ou vos filtres.</p>
    </div>
  <?php else: ?>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-gray-50">
          <tr class="text-left text-gray-500 text-xs uppercase tracking-wide">
            <th class="px-5 py-3 font-semibold">Client</th>
            <th class="px-5 py-3 font-semibold">Téléphone WhatsApp</th>
            <th class="px-5 py-3 font-semibold">Date d'inscription</th>
            <th class="px-5 py-3 font-semibold">Portefeuille</th>
            <th class="px-5 py-3 font-semibold">Segment</th>
            <th class="px-5 py-3 font-semibold">Statut</th>
            <th class="px-5 py-3 font-semibold text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
          <?php foreach ($clients as $client): ?>
            <?php
              $segmentStyles = [
                  'fidele'      => 'bg-emerald-50 text-emerald-600',
                  'nouveau'     => 'bg-blue-50 text-blue-600',
                  'occasionnel' => 'bg-amber-50 text-amber-600',
              ];
              $segmentLabels = ['fidele' => 'Fidèle', 'nouveau' => 'Nouveau', 'occasionnel' => 'Occasionnel'];
              $initials = mb_strtoupper(mb_substr($client['first_name'], 0, 1) . mb_substr($client['last_name'], 0, 1));
            ?>
            <tr class="hover:bg-gray-50/50 transition-colors">
              <td class="px-5 py-3.5">
                <div class="flex items-center gap-3">
                  <span class="w-9 h-9 rounded-full bg-brand-50 text-brand-500 flex items-center justify-center text-xs font-bold shrink-0">
                    <?= htmlspecialchars($initials) ?>
                  </span>
                  <p class="font-semibold text-ink"><?= htmlspecialchars($client['first_name'] . ' ' . $client['last_name']) ?></p>
                </div>
              </td>
              <td class="px-5 py-3.5 text-gray-600">
                <span class="inline-flex items-center gap-1.5">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.4A10 10 0 1 0 12 2z"/></svg>
                  <?= htmlspecialchars($client['phone_whatsapp']) ?>
                </span>
              </td>
              <td class="px-5 py-3.5 text-gray-500"><?= date('d/m/Y', strtotime($client['created_at'])) ?></td>
              <td class="px-5 py-3.5 font-semibold text-ink">
                <?= $client['wallet_balance'] !== null ? number_format($client['wallet_balance'], 2, ',', ' ') . ' €' : '—' ?>
              </td>
              <td class="px-5 py-3.5">
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full <?= $segmentStyles[$client['segment']] ?? 'bg-gray-100 text-gray-600' ?>">
                  <?= $segmentLabels[$client['segment']] ?? htmlspecialchars($client['segment']) ?>
                </span>
              </td>
              <td class="px-5 py-3.5">
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full <?= $client['status'] === 'actif' ? 'bg-emerald-50 text-emerald-600' : 'bg-gray-100 text-gray-500' ?>">
                  <?= $client['status'] === 'actif' ? 'Actif' : 'Inactif' ?>
                </span>
              </td>
              <td class="px-5 py-3.5 text-right">
                <button type="button"
                        onclick="document.getElementById('msg-modal-<?= $client['id'] ?>').classList.remove('hidden')"
                        class="inline-flex items-center gap-1.5 text-xs font-bold border-2 border-emerald-500 text-emerald-600 hover:bg-emerald-500 hover:text-white px-3 py-2 rounded-lg transition-colors">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.4A10 10 0 1 0 12 2z"/></svg>
                  Envoyer un message
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between px-5 py-4 border-t border-gray-50">
      <p class="text-xs text-gray-400"><?= $total ?> client<?= $total > 1 ? 's' : '' ?> au total</p>
      <?php if ($totalPages > 1): ?>
        <div class="flex items-center gap-1">
          <?php for ($p = 1; $p <= $totalPages; $p++): ?>
            <a href="<?= BASE_PATH ?>/admin/clients?<?= http_build_query(array_merge($filters, ['page' => $p])) ?>"
               class="w-8 h-8 flex items-center justify-center rounded-lg text-sm font-semibold transition-colors
                      <?= $p === $page ? 'bg-brand-500 text-white' : 'text-gray-500 hover:bg-gray-100' ?>">
              <?= $p ?>
            </a>
          <?php endfor; ?>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>

<!-- Modales d'envoi de message (une par client, cachées par défaut) -->
<?php foreach ($clients as $client): ?>
  <div id="msg-modal-<?= $client['id'] ?>" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md">
      <h3 class="font-bold text-lg text-ink mb-1">Message à <?= htmlspecialchars($client['first_name']) ?></h3>
      <p class="text-sm text-gray-500 mb-4"><?= htmlspecialchars($client['phone_whatsapp']) ?></p>
      <form method="POST" action="<?= BASE_PATH ?>/admin/clients/<?= $client['id'] ?>/message">
        <?= Csrf::field() ?>
        <textarea name="content" rows="4" required placeholder="Votre message WhatsApp..."
                  class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30 mb-4"></textarea>
        <div class="flex gap-2 justify-end">
          <button type="button" onclick="document.getElementById('msg-modal-<?= $client['id'] ?>').classList.add('hidden')"
                  class="px-4 py-2.5 text-sm font-semibold text-gray-500 hover:text-ink">Annuler</button>
          <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm px-5 py-2.5 rounded-lg transition-colors">Envoyer</button>
        </div>
      </form>
    </div>
  </div>
<?php endforeach; ?>
