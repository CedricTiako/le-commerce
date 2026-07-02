<?php
$gridTitle = $gridTitle ?? null;
$gridItems = $gridItems ?? [];
$gridCols = $gridCols ?? 2;
?>
<div class="card card-md">
  <?php if ($gridTitle): ?>
    <h2 class="font-bold text-lg text-ink mb-1"><?= htmlspecialchars($gridTitle) ?></h2>
    <div class="w-10 h-1 bg-brand-500 rounded-full mb-6"></div>
  <?php endif; ?>
  <div class="grid grid-cols-1 sm:grid-cols-2 <?= $gridCols === 3 ? 'lg:grid-cols-3' : '' ?> gap-5">
    <?php foreach ($gridItems as $item): ?>
      <div class="feature-card">
        <?php
          $keyword = rawurlencode($item['name'] ?? 'service');
          $imgUrl = siteImage($item['slug'] ?? '', "https://source.unsplash.com/600x400/?$keyword");
        ?>
        <div class="mb-3 rounded-md overflow-hidden">
          <img src="<?= $imgUrl ?>" alt="<?= htmlspecialchars($item['name'] ?? 'image') ?>" class="w-full h-28 object-cover" loading="lazy" decoding="async">
        </div>
        <div class="feature-icon">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="<?= $item['icon'] ?>"/>
          </svg>
        </div>
        <p class="font-semibold text-ink text-sm mb-1"><?= htmlspecialchars($item['name']) ?></p>
        <p class="text-gray-500 text-sm leading-relaxed"><?= htmlspecialchars($item['desc']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>
