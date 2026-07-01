<?php
$pageTitle = $pageTitle ?? '';
$pageSubtitle = $pageSubtitle ?? '';
$pageActions = $pageActions ?? [];
$pageBadge = $pageBadge ?? null;
?>
<div class="page-header">
  <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
    <div class="space-y-3">
      <?php if ($pageBadge): ?>
        <p class="page-badge"><?= htmlspecialchars($pageBadge) ?></p>
      <?php endif; ?>
      <h1 class="text-4xl font-extrabold text-ink leading-tight"><?= htmlspecialchars($pageTitle) ?></h1>
      <?php if ($pageSubtitle): ?>
        <p class="max-w-3xl text-sm leading-6 text-gray-500"><?= htmlspecialchars($pageSubtitle) ?></p>
      <?php endif; ?>
    </div>

    <?php if (!empty($pageActions)): ?>
      <div class="page-actions flex flex-wrap gap-3">
        <?php foreach ($pageActions as $action): ?>
          <a href="<?= htmlspecialchars($action['href']) ?>" class="<?= htmlspecialchars($action['class'] ?? 'btn-primary') ?>">
            <?= htmlspecialchars($action['label']) ?>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
