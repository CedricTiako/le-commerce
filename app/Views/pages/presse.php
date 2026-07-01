<?php
$heroEyebrow = 'PRESSE';
$heroText = "Quotidiens, presse régionale et magazines : toute l'actualité livrée chaque matin dans votre commerce de proximité.";
$heroActions = [
    ['href' => 'tel:' . $shop['phone_href'], 'label' => 'Appeler le commerce', 'class' => 'btn-primary'],
];
require __DIR__ . '/../partials/page-hero.php';
?>

<section class="max-w-[1536px] mx-auto px-6 lg:px-10 py-12 space-y-6">

  <?php
    $gridTitle = 'NOTRE OFFRE PRESSE';
    $gridItems = $categories;
    $gridCols = 2;
    require __DIR__ . '/../partials/feature-grid.php';
  ?>

  <div class="card card-md">
    <h2 class="font-bold text-ink mb-4">Un titre en particulier ?</h2>
    <p class="text-sm text-gray-500 mb-5">Vous cherchez un magazine précis ou souhaitez réserver vos titres à l'avance ? Contactez-nous, nous nous en occupons.</p>
    <ul class="space-y-2.5 mb-2">
      <?php foreach ($services as $service): ?>
        <li class="flex items-center gap-3 text-sm text-gray-600">
          <span class="w-6 h-6 rounded-md bg-brand-50 text-brand-500 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
          </span>
          <?= htmlspecialchars($service) ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="card card-md flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
      <h2 class="font-bold text-ink mb-1">Horaires de la presse</h2>
      <p class="text-sm text-gray-500">Lundi au Samedi : <?= htmlspecialchars($shop['hours']['lun_sam']) ?> · Dimanche : <?= htmlspecialchars($shop['hours']['dim']) ?></p>
    </div>
    <a href="<?= BASE_PATH ?>/contact" class="btn-primary shrink-0">Nous contacter</a>
  </div>
</section>
