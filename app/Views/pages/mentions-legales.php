<section class="max-w-[1536px] mx-auto px-6 lg:px-10 py-12">
  <div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-extrabold text-ink mb-2"><?= htmlspecialchars($heading) ?></h1>
    <p class="text-xs text-gray-400 mb-8">Dernière mise à jour : <?= date('d/m/Y') ?></p>

    <h2 class="text-xl font-bold text-ink mt-8 mb-3">Éditeur du site</h2>
    <p class="text-sm text-slate-600 leading-relaxed mb-4">
      Le présent site est édité par <strong><?= htmlspecialchars($shop['name']) ?></strong>,
      <?= htmlspecialchars($shop['legal']['forme_juridique'] ?: '—') ?>
      <?php if ($shop['legal']['capital_social'] !== ''): ?>
        au capital social de <?= htmlspecialchars($shop['legal']['capital_social']) ?>,
      <?php endif; ?>
      immatriculée sous le numéro SIRET <?= htmlspecialchars($shop['legal']['siret'] ?: '—') ?>
      <?php if ($shop['legal']['rcs_numero'] !== '' || $shop['legal']['rcs_ville'] !== ''): ?>
        (RCS <?= htmlspecialchars($shop['legal']['rcs_ville'] ?: '—') ?> <?= htmlspecialchars($shop['legal']['rcs_numero'] ?: '—') ?>),
      <?php endif; ?>
      dont le siège social est situé <?= htmlspecialchars($shop['address']) ?>, <?= htmlspecialchars($shop['zipcode'] . ' ' . $shop['city']) ?>.
    </p>
    <p class="text-sm text-slate-600 leading-relaxed mb-4">
      Téléphone : <?= htmlspecialchars($shop['phone']) ?><br>
      E-mail : <?= htmlspecialchars($shop['email']) ?>
    </p>

    <h2 class="text-xl font-bold text-ink mt-8 mb-3">Directeur de la publication</h2>
    <p class="text-sm text-slate-600 leading-relaxed mb-4">
      <?= htmlspecialchars($shop['legal']['directeur_publication'] ?: '—') ?>
    </p>

    <h2 class="text-xl font-bold text-ink mt-8 mb-3">Hébergement</h2>
    <p class="text-sm text-slate-600 leading-relaxed mb-4">
      Le site est hébergé par <?= htmlspecialchars($shop['legal']['hebergeur_nom'] ?: '—') ?>,
      <?= htmlspecialchars($shop['legal']['hebergeur_adresse'] ?: '—') ?>
      <?php if ($shop['legal']['hebergeur_telephone'] !== ''): ?>
        — <?= htmlspecialchars($shop['legal']['hebergeur_telephone']) ?>
      <?php endif; ?>.
    </p>

    <h2 class="text-xl font-bold text-ink mt-8 mb-3">Propriété intellectuelle</h2>
    <p class="text-sm text-slate-600 leading-relaxed mb-4">
      L'ensemble des contenus présents sur ce site (textes, images, logos, marques, mise en page) est protégé
      par le droit de la propriété intellectuelle. Toute reproduction, représentation ou diffusion, totale ou
      partielle, sans autorisation préalable de <?= htmlspecialchars($shop['name']) ?> est interdite.
    </p>

    <h2 class="text-xl font-bold text-ink mt-8 mb-3">Liens hypertextes</h2>
    <p class="text-sm text-slate-600 leading-relaxed mb-4">
      Ce site peut contenir des liens vers des sites tiers (réseaux sociaux notamment). <?= htmlspecialchars($shop['name']) ?>
      n'exerce aucun contrôle sur ces sites et décline toute responsabilité quant à leur contenu.
    </p>

    <h2 class="text-xl font-bold text-ink mt-8 mb-3">Données personnelles</h2>
    <p class="text-sm text-slate-600 leading-relaxed mb-4">
      Les données personnelles collectées via ce site sont traitées conformément à notre
      <a href="<?= BASE_PATH ?>/politique-de-confidentialite" class="text-brand-500 hover:text-brand-600 underline">Politique de Confidentialité</a>.
    </p>

    <h2 class="text-xl font-bold text-ink mt-8 mb-3">Droit applicable</h2>
    <p class="text-sm text-slate-600 leading-relaxed mb-4">
      Les présentes mentions légales sont soumises au droit français. En cas de litige, les tribunaux français
      seront seuls compétents.
    </p>
  </div>
</section>
