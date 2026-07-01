<?php
$navItems = [
    '/'             => 'Accueil',
    '/le-bar'       => 'Le Bar',
    '/tabac'        => 'Tabac',
    '/pmu'          => 'PMU',
    '/fdj'          => 'FDJ',
    '/presse'       => 'Presse',
    '/nos-services' => 'Nos Services',
    '/contact'      => 'Contact',
];
?>
<header class="sticky top-0 z-50 bg-white border-b border-gray-100">
  <div class="max-w-[1536px] mx-auto px-6 lg:px-10">
    <div class="flex items-center justify-between h-[84px]">

      <!-- Logo -->
      <a href="<?= BASE_PATH ?>/" class="flex flex-col leading-none shrink-0">
        <span class="font-logo text-[34px] font-bold text-brand-500 -mb-1">Le Commerce</span>
        <span class="text-[11px] tracking-[0.15em] text-gray-500 font-medium">BAR · TABAC · PMU · FDJ · PRESSE · NIRIO</span>
      </a>

      <!-- Navigation -->
      <nav class="hidden lg:flex items-center gap-8 text-[13px] font-bold tracking-wide text-ink">
        <?php foreach ($navItems as $href => $label): ?>
          <?php $isActive = $currentUri === $href; ?>
          <a href="<?= BASE_PATH . $href ?>"
             class="nav-link uppercase hover:text-brand-500 transition-colors <?= $isActive ? 'active text-brand-500' : '' ?>">
            <?= htmlspecialchars($label) ?>
          </a>
        <?php endforeach; ?>
      </nav>

      <!-- Actions -->
      <div class="flex items-center gap-3">
        <?php if ($currentUser): ?>
          <div class="hidden sm:flex items-center gap-2">
            <a href="<?= BASE_PATH . ($currentUser['role'] === 'admin' ? '/admin' : '/mon-compte') ?>"
               class="inline-flex items-center gap-2 text-sm font-bold text-ink hover:text-brand-500 transition-colors">
              <span class="w-8 h-8 rounded-full bg-brand-50 text-brand-500 flex items-center justify-center text-xs font-bold">
                <?= htmlspecialchars(mb_substr($currentUser['first_name'], 0, 1)) ?>
              </span>
              <?= htmlspecialchars($currentUser['first_name']) ?>
            </a>
            <form method="POST" action="<?= BASE_PATH ?>/deconnexion">
              <?= \App\Core\Csrf::field() ?>
              <button type="submit" class="text-xs font-semibold text-gray-400 hover:text-brand-500 transition-colors" aria-label="Déconnexion">
                Déconnexion
              </button>
            </form>
          </div>
        <?php else: ?>
          <a href="<?= BASE_PATH ?>/connexion" class="hidden sm:inline-flex items-center text-sm font-bold text-ink hover:text-brand-500 transition-colors">
            Connexion
          </a>
        <?php endif; ?>

        <a href="tel:<?= htmlspecialchars($shop['phone_href']) ?>"
           class="hidden sm:inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white text-[13px] font-bold px-5 py-3 rounded-full transition-colors shadow-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
            <path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.9 21 3 13.1 3 3c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.2.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8z"/>
          </svg>
          <?= htmlspecialchars($shop['phone']) ?>
        </a>
        <button id="mobile-menu-btn" class="lg:hidden p-2 text-ink" aria-label="Menu">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Menu mobile -->
  <div id="mobile-menu" class="hidden lg:hidden border-t border-gray-100 bg-white">
    <nav class="flex flex-col px-6 py-4 gap-1 text-[13px] font-bold uppercase tracking-wide">
      <?php foreach ($navItems as $href => $label): ?>
        <a href="<?= BASE_PATH . $href ?>" class="py-2.5 border-b border-gray-50 <?= $currentUri === $href ? 'text-brand-500' : 'text-ink' ?>">
          <?= htmlspecialchars($label) ?>
        </a>
      <?php endforeach; ?>

      <?php if ($currentUser): ?>
        <a href="<?= BASE_PATH . ($currentUser['role'] === 'admin' ? '/admin' : '/mon-compte') ?>" class="py-2.5 border-b border-gray-50 text-ink">
          Mon compte (<?= htmlspecialchars($currentUser['first_name']) ?>)
        </a>
        <form method="POST" action="<?= BASE_PATH ?>/deconnexion" class="py-2.5">
          <?= \App\Core\Csrf::field() ?>
          <button type="submit" class="text-brand-500 font-bold">Déconnexion</button>
        </form>
      <?php else: ?>
        <a href="<?= BASE_PATH ?>/connexion" class="py-2.5 border-b border-gray-50 text-ink">Connexion</a>
        <a href="<?= BASE_PATH ?>/inscription" class="py-2.5 border-b border-gray-50 text-ink">Créer un compte</a>
      <?php endif; ?>

      <a href="tel:<?= htmlspecialchars($shop['phone_href']) ?>" class="mt-3 inline-flex items-center justify-center gap-2 bg-brand-500 text-white font-bold px-5 py-3 rounded-full">
        <?= htmlspecialchars($shop['phone']) ?>
      </a>
    </nav>
  </div>
</header>
