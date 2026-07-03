<?php
$beers = $drinks ?: [];
$heroImage = siteImage('hero_accueil', 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?q=80&auto=format&fit=crop&w=1600');
?>

<!-- =====================  HERO  ===================== -->
<section class="bg-white">
  <div class="max-w-[1536px] mx-auto grid grid-cols-1 lg:grid-cols-2 lg:items-stretch">
    <div class="px-6 lg:px-10 xl:pl-16 py-10 lg:py-16 flex flex-col justify-center">
      <p class="text-brand-500 font-extrabold text-xs sm:text-sm tracking-[0.15em] uppercase mb-3">
        Votre commerce de proximité à <?= htmlspecialchars(mb_strtoupper($shop['city'])) ?>
      </p>
      <h1 class="text-5xl sm:text-6xl font-extrabold text-ink leading-[1.02] mb-2">LE COMMERCE</h1>
      <p class="text-sm sm:text-base font-bold tracking-[0.2em] text-ink uppercase mb-5">
        <?= htmlspecialchars($app['baseline']) ?>
      </p>
      <p class="text-slate-500 text-base leading-relaxed mb-8 max-w-md">
        Un lieu convivial où se retrouver, se détendre et profiter de nombreux services au quotidien.
      </p>
      <div class="flex flex-wrap gap-3">
        <a href="<?= BASE_PATH ?>/le-bar" class="btn-primary uppercase tracking-wide">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 3h13v9a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4V3z"/><path stroke-linecap="round" stroke-linejoin="round" d="M17 8h1.5a2.5 2.5 0 0 1 0 5H17"/><path stroke-linecap="round" stroke-linejoin="round" d="M6 19h9"/></svg>
          Découvrir le Bar
        </a>
        <a href="<?= BASE_PATH ?>/contact" class="btn-outline uppercase tracking-wide">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-7-6.1-7-11a7 7 0 1 1 14 0c0 4.9-7 11-7 11z"/><circle cx="12" cy="10" r="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Nous trouver
        </a>
      </div>
    </div>
    <div class="relative min-h-[280px] lg:min-h-0">
      <img src="<?= htmlspecialchars($heroImage) ?>" alt="Façade du commerce" class="absolute inset-0 w-full h-full object-cover" loading="eager" decoding="async">
    </div>
  </div>
</section>

<!-- =====================  BLOC 3 COLONNES  ===================== -->
<section class="max-w-[1536px] mx-auto px-6 lg:px-10 pb-10 grid grid-cols-1 lg:grid-cols-[1.6fr_1fr] gap-6">

  <!-- Colonne gauche : Bières + Planche -->
  <div class="flex flex-col gap-6">

    <!-- Nos bières -->
    <div class="bg-[#161513] rounded-2xl p-6 sm:p-8">
      <h2 class="text-white font-bold text-lg mb-1">NOS BIÈRES À DÉCOUVRIR</h2>
      <div class="w-10 h-1 bg-brand-500 rounded-full mb-6"></div>

      <div class="grid grid-cols-3 sm:grid-cols-5 gap-4 mb-6">
        <?php foreach ($beers as $beer): ?>
          <div class="text-center">
            <?= beerGlass(drinkTone($beer['category'])) ?>
            <p class="text-white text-xs font-semibold mt-2 leading-tight"><?= htmlspecialchars($beer['name']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>

      <a href="<?= BASE_PATH ?>/le-bar" class="flex items-center justify-between bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm px-6 py-3.5 rounded-full transition-colors">
        VOIR LA CARTE COMPLÈTE DES BOISSONS
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </a>
    </div>

    <!-- Planche à saucisson -->
    <div class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 grid grid-cols-1 sm:grid-cols-[220px_1fr] gap-6 items-center">
      <?php $saucissonImg = siteImage('bar_planche_saucisson', 'https://images.unsplash.com/photo-1626200926749-2dc71c4b6e6e?q=80&w=600&auto=format&fit=crop'); ?>
      <img
        src="<?= htmlspecialchars($saucissonImg) ?>"
        alt="Planche à saucisson, cornichons et fromage"
        class="w-full h-40 object-cover rounded-xl"
        loading="lazy" decoding="async">
      <div>
        <h2 class="font-bold text-lg text-ink mb-1">NOTRE PLANCHE À SAUCISSON</h2>
        <div class="w-10 h-1 bg-brand-500 rounded-full mb-3"></div>
        <p class="text-gray-500 text-sm mb-5">Saucisson, cornichons, fromage et pain frais. Le plaisir de partager un bon moment !</p>
        <a href="<?= BASE_PATH ?>/le-bar" class="btn-primary">
          Découvrir notre planche
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>
  </div>

  <!-- Colonne droite : WhatsApp + Services -->
  <div class="flex flex-col gap-6">

    <!-- WhatsApp -->
    <div class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8 text-center">
      <h2 class="font-bold text-lg text-ink mb-1">REJOIGNEZ-NOUS SUR <span class="text-emerald-500">WHATSAPP</span> !</h2>
      <div class="w-10 h-1 bg-brand-500 rounded-full mx-auto mb-3"></div>
      <p class="text-gray-500 text-sm mb-6">Recevez en exclusivité nos promotions, événements et nouveautés !</p>

      <div class="w-16 h-16 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center mx-auto mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.4A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.1-1.1l-.3-.2-2.9.8.8-2.8-.2-.3A8 8 0 1 1 12 20z"/></svg>
      </div>

      <a href="https://wa.me/<?= htmlspecialchars(str_replace(['+',' '], '', $shop['phone_href'])) ?>"
         target="_blank" rel="noopener" class="btn-whatsapp w-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.4A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.1-1.1l-.3-.2-2.9.8.8-2.8-.2-.3A8 8 0 1 1 12 20z"/></svg>
        Je m'inscris sur WhatsApp
      </a>
    </div>

    <!-- Tous les services -->
    <div class="bg-white border border-gray-100 rounded-2xl p-6 sm:p-8">
      <h2 class="font-bold text-lg text-ink mb-1">TOUS VOS SERVICES DU QUOTIDIEN</h2>
      <div class="w-10 h-1 bg-brand-500 rounded-full mb-4"></div>

      <?php
        $services = [
          'Payer vos factures', 'Amendes & sanctions', 'Paysafecard / Neosurf',
          'BlaBlaCar', 'Réserver votre place de bus', 'Relais colis',
          'Retrait d\'espèces', 'Et bien plus encore !',
        ];
      ?>
      <ul class="space-y-2.5 mb-5">
        <?php foreach ($services as $service): ?>
          <li class="flex items-center gap-3 text-sm text-gray-600">
            <span class="w-6 h-6 rounded-md bg-brand-50 text-brand-500 flex items-center justify-center shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </span>
            <?= htmlspecialchars($service) ?>
          </li>
        <?php endforeach; ?>
      </ul>

      <a href="<?= BASE_PATH ?>/nos-services" class="flex items-center justify-between bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm px-6 py-3.5 rounded-lg transition-colors">
        VOIR TOUS LES SERVICES
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- =====================  BANDE INFOS (4 colonnes)  ===================== -->
<section class="max-w-[1536px] mx-auto px-6 lg:px-10 pb-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

  <!-- Avis Google -->
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <h3 class="font-bold text-sm text-ink mb-4">AVIS GOOGLE</h3>
    <div class="flex items-center gap-3 mb-2">
      <svg class="w-8 h-8" viewBox="0 0 48 48"><path fill="#4285F4" d="M45.1 24.5c0-1.6-.1-3.1-.4-4.6H24v9h11.8c-.5 2.8-2.1 5.1-4.4 6.7v5.6h7.1c4.2-3.9 6.6-9.6 6.6-16.7z"/><path fill="#34A853" d="M24 46c6 0 11-2 14.6-5.4l-7.1-5.6c-2 1.4-4.5 2.2-7.5 2.2-5.8 0-10.7-3.9-12.4-9.2H4.3v5.8C7.9 41.1 15.3 46 24 46z"/><path fill="#FBBC05" d="M11.6 27.9c-.5-1.4-.7-2.9-.7-4.4s.3-3.1.7-4.4v-5.8H4.3C2.8 16.5 2 20.1 2 23.5s.8 7 2.3 10.2l7.3-5.8z"/><path fill="#EA4335" d="M24 10.9c3.3 0 6.2 1.1 8.5 3.3l6.3-6.3C34.9 4.2 29.9 2 24 2 15.3 2 7.9 6.9 4.3 13.7l7.3 5.8c1.7-5.3 6.6-9.2 12.4-9.2z"/></svg>
      <div>
        <div class="flex items-center gap-1 text-amber-400">
          <?php for ($i = 0; $i < 5; $i++): ?><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15l-5.5 3 2-6.5L1 7h6.5L10 1l2.5 6H19l-5.5 4.5 2 6.5z"/></svg><?php endfor; ?>
        </div>
        <p class="font-bold text-ink text-lg leading-none"><?= number_format($shop['google_rating'], 1) ?>/5</p>
      </div>
    </div>
    <p class="text-gray-500 text-xs mb-4">Basé sur plus de <?= $shop['google_reviews_count'] ?> avis</p>
    <a href="https://www.google.com/maps" target="_blank" rel="noopener" class="block text-center border border-gray-200 rounded-full py-2.5 text-sm font-semibold text-ink hover:bg-gray-50 transition-colors">Laisser un avis</a>
  </div>

  <!-- Bons plans -->
  <div class="bg-white border border-gray-100 rounded-2xl p-6">
    <h3 class="font-bold text-sm text-ink mb-4">LES BONS PLANS DU MOMENT</h3>
    <?php if ($deal): ?>
      <div class="bg-ink rounded-xl px-4 py-4 mb-3 text-center">
        <p class="text-brand-500 font-extrabold text-xl tracking-widest" style="text-shadow:0 0 8px rgba(200,16,46,.6)">
          <?= htmlspecialchars(mb_strtoupper($deal['title'])) ?>
        </p>
      </div>
      <p class="font-bold text-sm text-ink mb-1"><?= substr($deal['starts_at'],0,5) ?> - <?= substr($deal['ends_at'],0,5) ?></p>
      <p class="text-brand-500 font-bold text-sm mb-4"><?= htmlspecialchars(mb_strtoupper($deal['subtitle'])) ?></p>
    <?php endif; ?>
    <a href="<?= BASE_PATH ?>/le-bar" class="block text-center border border-gray-200 rounded-full py-2.5 text-sm font-semibold text-ink hover:bg-gray-50 transition-colors">En profiter</a>
  </div>

  <!-- Météo -->
  <div class="bg-white border border-gray-100 rounded-2xl p-6" id="weather-widget" data-lat="49.6136" data-lng="1.5399">
    <h3 class="font-bold text-sm text-ink mb-4">MÉTÉO À <?= htmlspecialchars(mb_strtoupper($shop['city'])) ?></h3>
    <div class="flex items-center gap-3 mb-2">
      <svg class="w-10 h-10 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><circle cx="8" cy="12" r="5"/><g class="text-gray-300" fill="currentColor"><path d="M14 16a4 4 0 0 0 0 8h6a3.5 3.5 0 0 0 .5-6.96A4.5 4.5 0 0 0 14 16z" transform="translate(0 -6)" fill="#d1d5db"/></g></svg>
      <p class="font-extrabold text-3xl text-ink" id="weather-temp">--°C</p>
    </div>
    <p class="text-gray-500 text-xs mb-4" id="weather-desc">Chargement…</p>
    <p class="text-gray-500 text-sm">Profitez de notre terrasse !</p>
  </div>

  <!-- Assistant -->
  <div class="bg-white border border-gray-100 rounded-2xl p-6 flex flex-col">
    <h3 class="font-bold text-sm text-ink mb-3">ASSISTANT LE COMMERCE</h3>
    <p class="text-sm text-gray-600 mb-3">Bonjour ! 👋<br>Que recherchez-vous aujourd'hui ?</p>
    <div class="flex flex-wrap gap-2 mb-3">
      <?php foreach (['Êtes-vous ouvert ?', 'Match ce soir ?', 'Bières disponibles ?', 'Horaires PMU ?', 'Réserver une table ?', 'Jeux FDJ ?'] as $chip): ?>
        <button type="button" class="chat-chip text-xs font-medium border border-gray-200 rounded-full px-3 py-1.5 hover:bg-gray-50"><?= htmlspecialchars($chip) ?></button>
      <?php endforeach; ?>
    </div>
    <form id="assistant-form" class="mt-auto flex gap-2">
      <input type="text" placeholder="Écrivez votre question…" class="min-w-0 flex-1 border border-gray-200 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30">
      <button type="submit" class="w-9 h-9 rounded-full bg-brand-500 hover:bg-brand-600 text-white flex items-center justify-center shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M2 21l21-9L2 3v7l15 2-15 2z"/></svg>
      </button>
    </form>
  </div>
</section>
