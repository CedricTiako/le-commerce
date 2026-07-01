<?php
$heroEyebrow = $heroEyebrow ?? null;
$heroActions = $heroActions ?? [];
?>
<section class="max-w-[1536px] mx-auto px-6 lg:px-10 pt-8">
  <div class="page-hero">
    <div class="max-w-2xl space-y-4">
      <?php if ($heroEyebrow): ?>
        <p class="eyebrow"><?= htmlspecialchars($heroEyebrow) ?></p>
      <?php endif; ?>
      <h1><?= htmlspecialchars($heading) ?></h1>
      <p><?= htmlspecialchars($heroText) ?></p>
      <?php if (!empty($heroActions)): ?>
        <div class="flex flex-wrap gap-3 pt-2">
          <?php foreach ($heroActions as $action): ?>
            <a href="<?= htmlspecialchars($action['href']) ?>" class="<?= htmlspecialchars($action['class'] ?? 'btn-primary') ?>">
              <?= htmlspecialchars($action['label']) ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
