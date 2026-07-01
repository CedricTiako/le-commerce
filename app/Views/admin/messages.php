<div class="space-y-6">
  <?php
  $pageTitle = 'Messages & WhatsApp';
  $pageSubtitle = 'Suivez les demandes clients entrantes et gardez le contact via WhatsApp directement depuis votre back-office.';
  $pageActions = [
    ['href' => BASE_PATH . '/admin/clients', 'label' => 'Clients', 'class' => 'btn-secondary'],
  ];
  require __DIR__ . '/../partials/admin-page-header.php';
  ?>

  <div class="grid gap-5 lg:grid-cols-5">
    <div class="card card-md lg:col-span-2">
      <p class="text-xs uppercase tracking-[0.2em] text-gray-500 font-semibold mb-3">Demandes contacts</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($contactTotal) ?></p>
      <p class="text-xs text-gray-400 mt-2">Messages reçus via le formulaire de contact</p>
      <p class="mt-3 text-sm font-semibold <?= $unreadContacts > 0 ? 'text-brand-600' : 'text-gray-400' ?>"><?= number_format($unreadContacts) ?> non lus</p>
    </div>
    <div class="card card-md lg:col-span-2">
      <p class="text-xs uppercase tracking-[0.2em] text-gray-500 font-semibold mb-3">WhatsApp</p>
      <p class="text-4xl font-extrabold text-ink"><?= number_format($whatsappTotal) ?></p>
      <p class="text-xs text-gray-400 mt-2">Messages envoyés et reçus</p>
    </div>
    <div class="card card-md bg-brand-50 border-brand-100 text-brand-900">
      <p class="text-xs uppercase tracking-[0.2em] font-semibold mb-3">Flux</p>
      <p class="text-2xl font-extrabold"><?= number_format($whatsappIncoming) ?></p>
      <p class="text-xs text-brand-900/80 mt-2">messages entrants</p>
      <p class="mt-4 text-sm text-brand-900/90">Répondez vite pour convertir les opportunités en visites.</p>
    </div>
  </div>

  <div class="grid gap-6 lg:grid-cols-2">
    <div class="card card-md">
      <div class="flex items-center justify-between mb-4">
        <p class="text-sm font-semibold text-gray-500 uppercase tracking-[0.18em]">Derniers messages</p>
        <span class="text-xs font-semibold text-brand-500">Contact</span>
      </div>
      <?php if (empty($latestContacts)): ?>
        <p class="text-sm text-gray-400 py-8 text-center">Aucun message de contact récent.</p>
      <?php else: ?>
        <div class="space-y-3">
          <?php foreach ($latestContacts as $message): ?>
            <div class="rounded-3xl border border-gray-100 bg-white p-4 shadow-sm">
              <div class="flex items-center justify-between mb-2">
                <p class="font-semibold text-ink"><?= htmlspecialchars($message['name']) ?></p>
                <span class="text-xs text-gray-400"><?= date('d/m/Y', strtotime($message['created_at'])) ?></span>
              </div>
              <p class="text-sm text-gray-500 truncate"><?= htmlspecialchars($message['subject'] ?: 'Sans objet') ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="card card-md">
      <div class="flex items-center justify-between mb-4">
        <p class="text-sm font-semibold text-gray-500 uppercase tracking-[0.18em]">Derniers WhatsApp</p>
        <span class="text-xs font-semibold text-brand-500">WhatsApp</span>
      </div>
      <?php if (empty($latestWhatsapps)): ?>
        <p class="text-sm text-gray-400 py-8 text-center">Aucune activité WhatsApp récente.</p>
      <?php else: ?>
        <div class="space-y-3">
          <?php foreach ($latestWhatsapps as $item): ?>
            <div class="rounded-3xl border border-gray-100 bg-white p-4 shadow-sm">
              <div class="flex items-center justify-between mb-2">
                <p class="font-semibold text-ink"><?= htmlspecialchars($item['direction'] === 'sortant' ? 'Sortant' : 'Entrant') ?></p>
                <span class="text-xs text-gray-400"><?= date('d/m/Y', strtotime($item['sent_at'])) ?></span>
              </div>
              <p class="text-sm text-gray-500 truncate"><?= htmlspecialchars($item['content']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
