<?php
$heroEyebrow = 'NOS SERVICES';
$heroText = "Un commerce de proximité qui simplifie votre quotidien : colis, factures, retraits d'espèces et bien plus, sans rendez-vous.";
$heroActions = [
    ['href' => BASE_PATH . '/contact', 'label' => 'Une question ?', 'class' => 'btn-primary'],
];
$heroSlug = 'hero_services';
require __DIR__ . '/../partials/page-hero.php';
?>

<section class="max-w-[1536px] mx-auto px-6 lg:px-10 py-12">
  <?php
    $gridTitle = 'TOUS VOS SERVICES DU QUOTIDIEN';
    $gridItems = $categories;
    $gridCols = 3;
    require __DIR__ . '/../partials/feature-grid.php';
  ?>
</section>
