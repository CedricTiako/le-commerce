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
<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-200/70 shadow-sm">
  <div class="max-w-[1536px] mx-auto px-6 lg:px-10">
    <div class="flex items-center justify-between h-[88px] gap-6">

      <!-- Logo -->
      <a href="<?= BASE_PATH ?>/" class="flex flex-col leading-none shrink-0 min-w-0">
        <span class="font-logo text-[26px] md:text-[34px] font-bold text-slate-900 -mb-1 whitespace-nowrap">Le Commerce</span>
        <span class="text-[8px] md:text-[11px] tracking-[0.12em] md:tracking-[0.22em] text-slate-500 font-semibold uppercase whitespace-nowrap">BAR · TABAC · PMU · FDJ · PRESSE · NIRIO</span>
      </a>

      <!-- Navigation -->
      <nav class="hidden xl:flex items-center gap-5 text-[13px] font-semibold tracking-[0.24em] text-slate-600">
        <?php foreach ($navItems as $href => $label): ?>
          <?php $isActive = $currentUri === $href; ?>
          <a href="<?= BASE_PATH . $href ?>"
             class="nav-link uppercase whitespace-nowrap transition-colors <?= $isActive ? 'active text-brand-600' : 'hover:text-slate-900' ?>">
            <?= htmlspecialchars($label) ?>
          </a>
        <?php endforeach; ?>
      </nav>

      <!-- Actions -->
      <div class="flex items-center gap-3">
        <?php if ($currentUser): ?>
          <div class="hidden md:flex items-center gap-3 rounded-full border border-gray-200 bg-slate-50 px-4 py-2">
            <a href="<?= BASE_PATH . ($currentUser['role'] === 'admin' ? '/admin' : '/mon-compte') ?>"
               class="inline-flex items-center gap-2 text-sm font-semibold text-slate-800 hover:text-brand-600 transition-colors">
              <span class="w-8 h-8 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center text-xs font-bold">
                <?= htmlspecialchars(mb_substr($currentUser['first_name'], 0, 1)) ?>
              </span>
              <?= htmlspecialchars($currentUser['first_name']) ?>
            </a>
            <form method="POST" action="<?= BASE_PATH ?>/deconnexion">
              <?= \App\Core\Csrf::field() ?>
              <button type="submit" class="text-xs font-semibold text-slate-500 hover:text-brand-600 transition-colors" aria-label="Déconnexion">
                Déconnexion
              </button>
            </form>
          </div>
        <?php else: ?>
          <a href="<?= BASE_PATH ?>/connexion" class="hidden md:inline-flex items-center whitespace-nowrap text-sm font-semibold text-slate-700 hover:text-brand-600 transition-colors">
            Connexion
          </a>
        <?php endif; ?>

        <a href="tel:<?= htmlspecialchars($shop['phone_href']) ?>"
           aria-label="Appeler le <?= htmlspecialchars($shop['phone']) ?>"
           class="hidden md:inline-flex shrink-0 items-center gap-2 whitespace-nowrap bg-slate-900 hover:bg-slate-800 text-white text-[13px] font-semibold px-5 xl:px-3.5 2xl:px-5 py-3 rounded-full transition-colors shadow-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor">
            <path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.9 21 3 13.1 3 3c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.2.2 2.5.6 3.6.1.4 0 .8-.2 1L6.6 10.8z"/>
          </svg>
          <span class="xl:hidden 2xl:inline"><?= htmlspecialchars($shop['phone']) ?></span>
        </a>
        <button id="mobile-menu-btn" class="xl:hidden p-2 text-slate-900" aria-label="Menu">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Menu mobile -->
  <div id="mobile-menu" class="hidden xl:hidden border-t border-gray-100 bg-white">
    <nav class="flex flex-col px-6 py-5 gap-1 text-[13px] font-semibold uppercase tracking-[0.24em]">
      <?php foreach ($navItems as $href => $label): ?>
        <a href="<?= BASE_PATH . $href ?>" class="py-3 border-b border-gray-100 <?= $currentUri === $href ? 'text-brand-600' : 'text-slate-700' ?>">
          <?= htmlspecialchars($label) ?>
        </a>
      <?php endforeach; ?>

      <?php if ($currentUser): ?>
        <a href="<?= BASE_PATH . ($currentUser['role'] === 'admin' ? '/admin' : '/mon-compte') ?>" class="py-3 border-b border-gray-100 text-slate-700">
          Mon compte (<?= htmlspecialchars($currentUser['first_name']) ?>)
        </a>
        <form method="POST" action="<?= BASE_PATH ?>/deconnexion" class="py-3">
          <?= \App\Core\Csrf::field() ?>
          <button type="submit" class="text-brand-600 font-bold">Déconnexion</button>
        </form>
      <?php else: ?>
        <a href="<?= BASE_PATH ?>/connexion" class="py-3 border-b border-gray-100 text-slate-700">Connexion</a>
        <a href="<?= BASE_PATH ?>/inscription" class="py-3 border-b border-gray-100 text-slate-700">Créer un compte</a>
      <?php endif; ?>

      <a href="tel:<?= htmlspecialchars($shop['phone_href']) ?>" class="mt-4 inline-flex items-center justify-center gap-2 bg-slate-900 text-white font-semibold px-5 py-3 rounded-full">
        <?= htmlspecialchars($shop['phone']) ?>
      </a>
    </nav>
  </div>
</header>
