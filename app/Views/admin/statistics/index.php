<p class="text-sm text-gray-500 mb-6">Vue d'ensemble des performances de votre établissement.</p>

<!-- KPIs -->
<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <p class="text-sm font-semibold text-gray-500 mb-2">Solde total portefeuilles</p>
    <p class="font-extrabold text-3xl text-ink"><?= number_format($totalBalance, 2, ',', ' ') ?> €</p>
  </div>
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <p class="text-sm font-semibold text-gray-500 mb-2">Total clients</p>
    <p class="font-extrabold text-3xl text-ink"><?= $totalClients ?></p>
  </div>
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <p class="text-sm font-semibold text-gray-500 mb-2">Offres utilisées ce mois</p>
    <p class="font-extrabold text-3xl text-ink"><?= $offersUsed ?></p>
  </div>
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <p class="text-sm font-semibold text-gray-500 mb-2">Participations sondages</p>
    <p class="font-extrabold text-3xl text-ink"><?= $pollsParticipations ?></p>
  </div>
</div>

<div class="grid lg:grid-cols-3 gap-6 mb-6">
  <div class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl p-6">
    <h2 class="font-bold text-ink mb-4">Recharges &amp; dépenses (14 derniers jours)</h2>
    <canvas id="chart-activity" height="110"></canvas>
  </div>
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <h2 class="font-bold text-ink mb-4">Moyens de paiement</h2>
    <canvas id="chart-payments" height="180"></canvas>
  </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">
  <div class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl p-6">
    <h2 class="font-bold text-ink mb-4">Nouveaux clients par mois</h2>
    <canvas id="chart-clients" height="110"></canvas>
  </div>
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <h2 class="font-bold text-ink mb-4">Top 5 clients (dépenses)</h2>
    <?php if (empty($topClients)): ?>
      <p class="text-sm text-gray-400">Pas encore de données.</p>
    <?php else: ?>
      <ul class="space-y-3">
        <?php foreach ($topClients as $c): ?>
          <li class="flex items-center justify-between text-sm">
            <span class="font-medium text-ink"><?= htmlspecialchars($c['first_name'] . ' ' . $c['last_name']) ?></span>
            <span class="font-bold text-ink"><?= number_format($c['total_spent'], 2, ',', ' ') ?> €</span>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
(function () {
  if (typeof Chart === 'undefined') return; // pas de connexion internet : on n'affiche pas de graphique cassé

  const brand = '#c8102e', emerald = '#10b981', gray = '#e5e7eb';
  Chart.defaults.font.family = 'Poppins, sans-serif';
  Chart.defaults.color = '#6b7280';

  // Activité portefeuille
  const activity = <?= json_encode($walletActivity) ?>;
  new Chart(document.getElementById('chart-activity'), {
    type: 'line',
    data: {
      labels: activity.map(a => new Date(a.jour).toLocaleDateString('fr-FR', { day: '2-digit', month: '2-digit' })),
      datasets: [
        { label: 'Recharges', data: activity.map(a => parseFloat(a.recharges)), borderColor: emerald, backgroundColor: emerald + '20', tension: 0.35, fill: true },
        { label: 'Dépenses', data: activity.map(a => parseFloat(a.depenses)), borderColor: brand, backgroundColor: brand + '15', tension: 0.35, fill: true },
      ],
    },
    options: { plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true } } },
  });

  // Moyens de paiement
  const payments = <?= json_encode($paymentBreakdown) ?>;
  const paymentLabels = { carte_bancaire: 'Carte bancaire', especes: 'Espèces', apple_pay: 'Apple Pay', google_pay: 'Google Pay', portefeuille: 'Portefeuille' };
  new Chart(document.getElementById('chart-payments'), {
    type: 'doughnut',
    data: {
      labels: payments.map(p => paymentLabels[p.payment_method] || p.payment_method),
      datasets: [{ data: payments.map(p => parseFloat(p.total)), backgroundColor: [brand, emerald, '#3b82f6', '#f59e0b', '#8b5cf6'] }],
    },
    options: { plugins: { legend: { position: 'bottom' } } },
  });

  // Nouveaux clients par mois
  const clients = <?= json_encode($newClientsByMonth) ?>;
  new Chart(document.getElementById('chart-clients'), {
    type: 'bar',
    data: {
      labels: clients.map(c => c.mois),
      datasets: [{ label: 'Nouveaux clients', data: clients.map(c => parseInt(c.nb, 10)), backgroundColor: brand, borderRadius: 6 }],
    },
    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } },
  });
})();
</script>
