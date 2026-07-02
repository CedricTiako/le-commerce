<?php use App\Core\Csrf; ?>

<?php
$pageTitle = 'Photos du site';
$pageSubtitle = "Uploadez les vraies photos du commerce pour chaque emplacement. Tant qu'aucune photo n'est envoyée, le visuel par défaut reste affiché sur le site.";
$pageActions = [];
require __DIR__ . '/../../partials/admin-page-header.php';
?>

<div class="space-y-6">
  <?php foreach ($catalog as $sectionTitle => $items): ?>
    <div class="card card-md">
      <h2 class="font-bold text-ink mb-4"><?= htmlspecialchars($sectionTitle) ?></h2>
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
        <?php foreach ($items as $slug => $label): ?>
          <?php $current = $values[$slug] ?? null; ?>
          <div class="space-y-2">
            <div class="aspect-video rounded-xl overflow-hidden border border-gray-200 bg-gray-50 flex items-center justify-center">
              <?php if ($current): ?>
                <img src="<?= BASE_PATH . htmlspecialchars($current) ?>" alt="<?= htmlspecialchars($label) ?>" class="w-full h-full object-cover">
              <?php else: ?>
                <span class="text-[11px] text-gray-400 text-center px-2 leading-tight">Photo par défaut<br>(Unsplash)</span>
              <?php endif; ?>
            </div>
            <p class="text-xs font-semibold text-ink leading-tight"><?= htmlspecialchars($label) ?></p>

            <form method="POST" action="<?= BASE_PATH ?>/admin/images" enctype="multipart/form-data" class="flex items-center gap-2">
              <?= Csrf::field() ?>
              <input type="hidden" name="slug" value="<?= htmlspecialchars($slug) ?>">
              <input type="file" name="image" accept="image/jpeg,image/png,image/webp" required
                     class="text-[11px] w-full file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-[11px] file:font-semibold file:bg-brand-50 file:text-brand-600">
              <button type="submit" class="shrink-0 text-[11px] font-semibold text-brand-600 hover:text-brand-700">Envoyer</button>
            </form>

            <?php if ($current): ?>
              <form method="POST" action="<?= BASE_PATH ?>/admin/images/<?= urlencode($slug) ?>/supprimer">
                <?= Csrf::field() ?>
                <button type="submit" class="text-[11px] font-semibold text-red-500 hover:text-red-600">Retirer la photo</button>
              </form>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endforeach; ?>
</div>
