<div class="space-y-6">
  <?php
  $pageTitle = 'Réservations';
  $pageSubtitle = 'Suivez les demandes de réservation et les messages clients provenant de votre formulaire et WhatsApp.';
  $pageActions = [
    ['href' => BASE_PATH . '/admin/messages', 'label' => 'Voir les messages', 'class' => 'btn-primary'],
  ];
  require __DIR__ . '/../partials/admin-page-header.php';
  ?>

  <div class="grid gap-5 lg:grid-cols-3">
    <div class="card card-md">
      <p class="text-xs uppercase tracking-[0.2em] text-gray-500 font-semibold mb-3">Demandes totales</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($messageDemandCount) ?></p>
      <p class="text-xs text-gray-400 mt-2">Demandes de réservation estimées</p>
    </div>
    <div class="card card-md">
      <p class="text-xs uppercase tracking-[0.2em] text-gray-500 font-semibold mb-3">Contact</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($contactTotal) ?></p>
      <p class="text-xs text-gray-400 mt-2">Messages provenant du formulaire</p>
    </div>
    <div class="card card-md">
      <p class="text-xs uppercase tracking-[0.2em] text-gray-500 font-semibold mb-3">WhatsApp entrants</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($whatsappTotal) ?></p>
      <p class="text-xs text-gray-400 mt-2">Demandes clients directement sur WhatsApp</p>
    </div>
  </div>

  <div class="grid gap-6 lg:grid-cols-2">
    <div class="card card-md">
      <div class="flex items-center justify-between mb-4">
        <div>
          <p class="text-sm font-semibold text-gray-500 uppercase tracking-[0.18em]">Messages de réservation</p>
          <h2 class="text-xl font-bold text-ink">Contact</h2>
        </div>
      </div>
      <?php if (empty($latestContacts)): ?>
        <p class="text-sm text-gray-400 py-8 text-center">Aucun message de réservation récent.</p>
      <?php else: ?>
        <div class="space-y-3">
          <?php foreach ($latestContacts as $message): ?>
            <div class="rounded-3xl border border-gray-100 bg-white p-4 shadow-sm">
              <p class="font-semibold text-ink"><?= htmlspecialchars($message['name']) ?></p>
              <p class="text-xs text-gray-400 mb-2"><?= date('d/m/Y H:i', strtotime($message['created_at'])) ?></p>
              <p class="text-sm text-gray-500 truncate"><?= htmlspecialchars($message['subject'] ?: 'Demande de réservation') ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="card card-md bg-brand-50 border-brand-100 text-brand-900">
      <div class="flex items-center justify-between mb-4">
        <div>
          <p class="text-sm font-semibold uppercase tracking-[0.18em]">WhatsApp entrant</p>
          <h2 class="text-xl font-bold text-ink">Dernières discussions</h2>
        </div>
      </div>
      <?php if (empty($latestWhatsapps)): ?>
        <p class="text-sm text-brand-900/80 py-8 text-center">Aucun message WhatsApp entrant récent.</p>
      <?php else: ?>
        <div class="space-y-3">
          <?php foreach ($latestWhatsapps as $item): ?>
            <div class="rounded-3xl border border-white/30 bg-white/90 p-4 shadow-sm">
              <p class="font-semibold text-ink"><?= htmlspecialchars($item['direction'] === 'entrant' ? 'Entrant' : 'Sortant') ?></p>
              <p class="text-xs text-brand-900/70 mb-2"><?= date('d/m/Y H:i', strtotime($item['sent_at'])) ?></p>
              <p class="text-sm text-brand-900/80 truncate"><?= htmlspecialchars($item['content']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="card card-md">
    <h2 class="font-bold text-ink mb-4">Processus de réservation</h2>
    <p class="text-sm leading-6 text-gray-600">Les demandes de réservation arrivent via votre formulaire de contact et WhatsApp. Conservez ces échanges comme priorités de traitement, puis confirmez la disponibilité en boutique.</p>
  </div>
</div>
