<?php
$heroEyebrow = $heroEyebrow ?? null;
$heroImage = $heroImage ?? 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?q=80&auto=format&fit=crop&w=1600';
$heroActions = $heroActions ?? [];
?>
<section class="max-w-[1536px] mx-auto px-6 lg:px-10 py-12">
  <div class="page-hero overflow-hidden rounded-[32px] bg-slate-950 text-white shadow-[0_40px_120px_-60px_rgba(15,23,42,0.9)]">
    <div class="relative overflow-hidden px-6 py-14 sm:px-10 lg:px-16 xl:px-20">
      <div class="absolute inset-0 -z-20">
        <picture>
          <source type="image/webp" srcset="<?= htmlspecialchars(str_replace('auto=format','fm=webp', $heroImage)) ?>&w=800 800w, <?= htmlspecialchars(str_replace('auto=format','fm=webp', $heroImage)) ?>&w=1200 1200w" sizes="100vw">
          <img src="<?= htmlspecialchars($heroImage) ?>" srcset="<?= htmlspecialchars($heroImage) ?>&w=800 800w, <?= htmlspecialchars($heroImage) ?>&w=1200 1200w" sizes="100vw" alt="" class="w-full h-full object-cover scale-[1.06]" loading="lazy" decoding="async">
        </picture>
      </div>
      <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(248,113,113,0.18),transparent_25%),radial-gradient(circle_at_bottom_right,rgba(248,113,113,0.1),transparent_20%)] pointer-events-none"></div>
      <div class="relative max-w-3xl space-y-6">
        <?php if ($heroEyebrow): ?>
          <p class="eyebrow text-brand-100/90"><?= htmlspecialchars($heroEyebrow) ?></p>
        <?php endif; ?>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-[1.04] text-white">
          <?= htmlspecialchars($heading) ?>
        </h1>
        <p class="max-w-2xl text-sm sm:text-base text-slate-300 leading-8">
          <?= htmlspecialchars($heroText) ?>
        </p>

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
  </div>
</section>
