<header class="h-[76px] shrink-0 bg-white border-b border-gray-100 flex items-center justify-between px-6 lg:px-8">
  <div class="flex items-center gap-4">
    <button id="admin-mobile-menu-btn" class="lg:hidden p-2 -ml-2 text-ink" aria-label="Menu">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
    <h1 class="font-bold text-lg text-ink hidden sm:block"><?= htmlspecialchars($pageTitle ?? 'Tableau de bord') ?></h1>
  </div>

  <div class="flex items-center gap-4">
    <a href="tel:<?= htmlspecialchars($shop['phone_href']) ?>" class="hidden md:inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white text-[13px] font-bold px-4 py-2.5 rounded-full transition-colors">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.9 21 3 13.1 3 3c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.2.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8z"/></svg>
      <?= htmlspecialchars($shop['phone']) ?>
    </a>

    <?php if ($currentUser): ?>
      <div class="flex items-center gap-2.5 pl-3 border-l border-gray-100">
        <span class="w-9 h-9 rounded-full bg-brand-50 text-brand-500 flex items-center justify-center text-sm font-bold">
          <?= htmlspecialchars(mb_substr($currentUser['first_name'], 0, 1)) ?>
        </span>
        <div class="hidden sm:block leading-tight">
          <p class="text-sm font-bold text-ink"><?= htmlspecialchars($shop['name']) ?></p>
          <p class="text-xs text-gray-400">Administrateur</p>
        </div>
      </div>
    <?php endif; ?>
  </div>
</header>
