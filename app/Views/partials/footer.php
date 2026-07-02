<footer class="bg-slate-950 text-slate-300">
  <div class="max-w-[1536px] mx-auto px-6 lg:px-10 py-14">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

      <!-- Logo -->
      <div>
        <span class="font-logo text-[32px] font-bold text-brand-500 block -mb-1"><?= htmlspecialchars($shop['name']) ?></span>
        <p class="text-[11px] tracking-[0.22em] text-slate-500 font-semibold mt-1 uppercase">BAR · TABAC · PMU · FDJ · PRESSE · NIRIO</p>
        <p class="text-sm text-slate-400 leading-relaxed mt-5">Un commerce de proximité qui vous accueille avec professionnalisme et services rapides au cœur de <?= htmlspecialchars($shop['city']) ?>.</p>
      </div>

      <div>
        <h3 class="font-semibold text-white mb-4">Coordonnées</h3>
        <div class="space-y-3 text-sm text-slate-400">
          <p><?= htmlspecialchars($shop['address']) ?><br><?= htmlspecialchars($shop['zipcode'] . ' ' . $shop['city']) ?></p>
          <p>Téléphone : <a href="tel:<?= htmlspecialchars($shop['phone_href']) ?>" class="text-brand-500 hover:text-brand-400"><?= htmlspecialchars($shop['phone']) ?></a></p>
          <p>Email : <a href="mailto:<?= htmlspecialchars($shop['email']) ?>" class="text-brand-500 hover:text-brand-400 break-all"><?= htmlspecialchars($shop['email']) ?></a></p>
        </div>
      </div>

      <div>
        <h3 class="font-semibold text-white mb-4">Horaires</h3>
        <div class="space-y-2 text-sm text-slate-400">
          <p>Lundi au Samedi : <?= htmlspecialchars($shop['hours']['lun_sam']) ?></p>
          <p>Dimanche : <?= htmlspecialchars($shop['hours']['dim']) ?></p>
        </div>
      </div>

      <div>
        <h3 class="font-semibold text-white mb-4">Suivez-nous</h3>
        <p class="text-sm text-slate-400 mb-4">Retrouvez-nous sur Facebook et Instagram pour nos offres exclusives.</p>
        <div class="flex items-center gap-3">
          <a href="<?= htmlspecialchars($shop['social']['facebook']) ?>" target="_blank" rel="noopener" aria-label="Facebook"
             class="w-10 h-10 rounded-full bg-brand-500 hover:bg-brand-600 flex items-center justify-center transition-colors text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M13.5 21v-7.4h2.5l.4-2.9h-2.9V8.8c0-.85.24-1.43 1.46-1.43H16.5V4.8c-.26-.03-1.15-.11-2.19-.11-2.17 0-3.65 1.32-3.65 3.75v2.26H8.2v2.9h2.46V21h2.84z"/></svg>
          </a>
          <a href="<?= htmlspecialchars($shop['social']['instagram']) ?>" target="_blank" rel="noopener" aria-label="Instagram"
             class="w-10 h-10 rounded-full bg-brand-500 hover:bg-brand-600 flex items-center justify-center transition-colors text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.2c2.7 0 3 0 4 .05 1 .05 1.7.2 2.3.45.6.25 1.1.6 1.6 1.1.5.5.85 1 1.1 1.6.25.6.4 1.3.45 2.3.05 1 .05 1.3.05 4s0 3-.05 4c-.05 1-.2 1.7-.45 2.3-.25.6-.6 1.1-1.1 1.6-.5.5-1 .85-1.6 1.1-.6.25-1.3.4-2.3.45-1 .05-1.3.05-4 .05s-3 0-4-.05c-1-.05-1.7-.2-2.3-.45-.6-.25-1.1-.6-1.6-1.1-.5-.5-.85-1-1.1-1.6-.25-.6-.4-1.3-.45-2.3-.05-1-.05-1.3-.05-4s0-3 .05-4c.05-1 .2-1.7.45-2.3.25-.6.6-1.1 1.1-1.6.5-.5 1-.85 1.6-1.1.6-.25 1.3-.4 2.3-.45 1-.05 1.3-.05 4-.05zM12 0C9.3 0 8.9 0 7.9.06 6.8.1 6 .3 5.3.6c-.8.3-1.4.7-2.1 1.3C2.5 2.6 2.1 3.2 1.8 4c-.3.7-.5 1.5-.55 2.6C1.2 7.6 1.2 8 1.2 10.7v2.6c0 2.7 0 3.1.06 4.1.05 1.1.25 1.9.55 2.6.3.8.7 1.4 1.3 2.1.7.6 1.3 1 2.1 1.3.7.3 1.5.5 2.6.55 1.1.06 1.5.06 4.1.06s3.1 0 4.1-.06c1.1-.05 1.9-.25 2.6-.55.8-.3 1.4-.7 2.1-1.3.6-.7 1-1.3 1.3-2.1.3-.7.5-1.5.55-2.6.06-1.1.06-1.5.06-4.1v-2.6c0-2.7 0-3.1-.06-4.1-.05-1.1-.25-1.9-.55-2.6-.3-.8-.7-1.4-1.3-2.1-.7-.6-1.3-1-2.1-1.3-.7-.3-1.5-.5-2.6-.55C15.1 0 14.7 0 12 0zM12 5.8a6.2 6.2 0 1 0 0 12.4 6.2 6.2 0 0 0 0-12.4zm0 10.2a4 4 0 1 1 0-8 4 4 0 0 1 0 8zM19.6 5.6a1.44 1.44 0 1 1-2.88 0 1.44 1.44 0 0 1 2.88 0z"/></svg>
          </a>
        </div>
      </div>
    </div>

    <div class="border-t border-slate-800 mt-10 pt-6 flex flex-col md:flex-row items-center justify-between gap-3 text-xs text-slate-500">
      <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($shop['name']) ?> - Tous droits réservés</p>
      <div class="flex gap-2">
        <span class="inline-block w-6 h-6 rounded bg-slate-800"></span>
        <span class="inline-block w-6 h-6 rounded bg-slate-800"></span>
      </div>
    </div>
  </div>
</footer>
