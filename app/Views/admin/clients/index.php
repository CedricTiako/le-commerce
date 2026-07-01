<?php use App\Core\Csrf; ?>

<?php
$pageTitle = 'Clients inscrits';
$pageSubtitle = 'Retrouvez vos clients et suivez leur engagement, les segments et le solde de portefeuille directement depuis votre back-office.';
$pageActions = [
    ['href' => BASE_PATH . '/admin/clients/export?' . http_build_query($filters), 'label' => 'Exporter la liste', 'class' => 'btn-secondary'],
];
require __DIR__ . '/../../partials/admin-page-header.php';
?>



<div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-6">
  <div class="card card-md">
    <p class="text-xs uppercase tracking-[0.24em] text-gray-400 font-semibold">Total clients</p>
    <div class="mt-4 flex items-center gap-3">
      <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-50 text-brand-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"/></svg>
      </div>
      <div>
        <p class="text-3xl font-bold text-ink"><?= $totalAll ?></p>
        <p class="text-sm text-emerald-500 font-semibold">+<?= $newThisMonth ?> ce mois-ci</p>
      </div>
    </div>
  </div>
</div>

<!-- Filtres -->
<form method="GET" action="<?= BASE_PATH ?>/admin/clients" class="bg-white border border-gray-100 rounded-[32px] p-6 mb-6 shadow-sm">
  <div class="grid gap-4 xl:grid-cols-[1.8fr_1fr_1fr]">
    <div class="relative">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
      <input type="text" name="q" placeholder="Rechercher un client..." value="<?= htmlspecialchars($filters['q']) ?>"
             class="w-full border border-gray-200 rounded-2xl pl-11 pr-4 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30 focus:border-brand-500">
    </div>

    <div class="grid gap-4">
      <select name="status" class="border border-gray-200 rounded-2xl px-4 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30">
        <option value="tous"    <?= $filters['status'] === 'tous' ? 'selected' : '' ?>>Tous les statuts</option>
        <option value="actif"   <?= $filters['status'] === 'actif' ? 'selected' : '' ?>>Actif</option>
        <option value="inactif" <?= $filters['status'] === 'inactif' ? 'selected' : '' ?>>Inactif</option>
      </select>
      <select name="segment" class="border border-gray-200 rounded-2xl px-4 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30">
        <option value="tous"        <?= $filters['segment'] === 'tous' ? 'selected' : '' ?>>Tous les segments</option>
        <option value="nouveau"     <?= $filters['segment'] === 'nouveau' ? 'selected' : '' ?>>Nouveau</option>
        <option value="fidele"      <?= $filters['segment'] === 'fidele' ? 'selected' : '' ?>>Fidèle</option>
        <option value="occasionnel" <?= $filters['segment'] === 'occasionnel' ? 'selected' : '' ?>>Occasionnel</option>
      </select>
    </div>

    <div class="grid gap-4">
      <div class="grid gap-2">
        <label class="text-xs font-semibold uppercase tracking-[0.25em] text-gray-400">Inscrit depuis</label>
        <input type="date" name="from" value="<?= htmlspecialchars($filters['from']) ?>" class="w-full border border-gray-200 rounded-2xl px-4 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30" title="Inscrit depuis le">
      </div>
      <div class="grid gap-2">
        <label class="text-xs font-semibold uppercase tracking-[0.25em] text-gray-400">Inscrit jusqu'au</label>
        <input type="date" name="to" value="<?= htmlspecialchars($filters['to']) ?>" class="w-full border border-gray-200 rounded-2xl px-4 py-4 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30" title="Inscrit jusqu'au">
      </div>
      <div class="flex items-end justify-end">
        <button type="submit" class="inline-flex items-center gap-2 rounded-2xl bg-brand-500 px-5 py-4 text-sm font-bold text-white transition-colors hover:bg-brand-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M6 8h12M10 12h4M11 16h2"/></svg>
          Filtrer
        </button>
      </div>
    </div>
  </div>
</form>

<!-- Table -->
<div class="overflow-hidden rounded-[28px] border border-gray-100 bg-white shadow-sm">
  <?php if (empty($clients)): ?>
    <div class="text-center py-16 px-6">
      <p class="text-gray-500 font-medium mb-1">Aucun client ne correspond à ces critères.</p>
      <p class="text-gray-400 text-sm">Essayez d'élargir votre recherche ou vos filtres.</p>
    </div>
  <?php else: ?>
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-gray-50">
          <tr class="text-left text-gray-500 text-[11px] uppercase tracking-[0.24em]">
            <th class="px-6 py-4 font-semibold">Client</th>
            <th class="px-6 py-4 font-semibold">Téléphone WhatsApp</th>
            <th class="px-6 py-4 font-semibold">Date d'inscription</th>
            <th class="px-6 py-4 font-semibold">Portefeuille</th>
            <th class="px-6 py-4 font-semibold">Segment</th>
            <th class="px-6 py-4 font-semibold">Statut</th>
            <th class="px-6 py-4 font-semibold text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
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
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-5">
                <div class="flex items-center gap-3">
                  <span class="w-10 h-10 rounded-full bg-brand-50 text-brand-500 flex items-center justify-center text-xs font-bold shrink-0">
                    <?= htmlspecialchars($initials) ?>
                  </span>
                  <div>
                    <p class="font-semibold text-ink"><?= htmlspecialchars($client['first_name'] . ' ' . $client['last_name']) ?></p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-5 text-gray-600 whitespace-nowrap">
                <div class="inline-flex items-center gap-2">
                  <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                  <?= htmlspecialchars($client['phone_whatsapp']) ?>
                </div>
              </td>
              <td class="px-6 py-5 text-gray-500 whitespace-nowrap"><?= date('d/m/Y', strtotime($client['created_at'])) ?></td>
              <td class="px-6 py-5 font-semibold text-ink">
                <?= $client['wallet_balance'] !== null ? number_format($client['wallet_balance'], 2, ',', ' ') . ' €' : '—' ?>
              </td>
              <td class="px-6 py-5">
                <span class="text-xs font-semibold px-3 py-1.5 rounded-full <?= $segmentStyles[$client['segment']] ?? 'bg-gray-100 text-gray-600' ?>">
                  <?= $segmentLabels[$client['segment']] ?? htmlspecialchars($client['segment']) ?>
                </span>
              </td>
              <td class="px-6 py-5">
                <span class="text-xs font-semibold px-3 py-1.5 rounded-full <?= $client['status'] === 'actif' ? 'bg-emerald-50 text-emerald-600' : 'bg-gray-100 text-gray-500' ?>">
                  <?= $client['status'] === 'actif' ? 'Actif' : 'Inactif' ?>
                </span>
              </td>
              <td class="px-6 py-5 text-right">
                <button type="button"
                        onclick="document.getElementById('msg-modal-<?= $client['id'] ?>').classList.remove('hidden')"
                        class="inline-flex items-center gap-2 text-xs font-bold border-2 border-emerald-500 text-emerald-600 hover:bg-emerald-500 hover:text-white px-4 py-2 rounded-2xl transition-colors">
                  <span class="inline-flex items-center justify-center w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                  Envoyer un message
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="flex flex-col gap-4 px-6 py-5 border-t border-gray-100 bg-slate-50 sm:flex-row sm:items-center sm:justify-between">
      <p class="text-xs text-gray-500"><?= $total ?> client<?= $total > 1 ? 's' : '' ?> au total</p>
      <?php if ($totalPages > 1): ?>
        <div class="flex items-center gap-2">
          <?php for ($p = 1; $p <= $totalPages; $p++): ?>
            <a href="<?= BASE_PATH ?>/admin/clients?<?= http_build_query(array_merge($filters, ['page' => $p])) ?>"
               class="w-10 h-10 flex items-center justify-center rounded-2xl text-sm font-semibold transition-colors
                      <?= $p === $page ? 'bg-brand-500 text-white shadow-sm' : 'text-gray-500 hover:bg-gray-100' ?>">
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
                  class="form-textarea mb-4"></textarea>
        <div class="flex gap-2 justify-end">
          <button type="button" onclick="document.getElementById('msg-modal-<?= $client['id'] ?>').classList.add('hidden')"
                  class="px-4 py-2.5 text-sm font-semibold text-gray-500 hover:text-ink">Annuler</button>
          <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm px-5 py-2.5 rounded-lg transition-colors">Envoyer</button>
        </div>
      </form>
    </div>
  </div>
<?php endforeach; ?>
