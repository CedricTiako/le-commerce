<?php use App\Core\Csrf; ?>

<?php
$pageTitle = 'Paramètres du commerce';
$pageSubtitle = 'Modifiez les informations de votre établissement et les coordonnées utilisées partout sur le site.';
$pageActions = [];
require __DIR__ . '/../../partials/admin-page-header.php';
?>



<div class="max-w-4xl mx-auto space-y-6">
  <div class="card card-md">
    <p class="text-sm text-gray-500">Ces informations sont utilisées sur tout le site (en-tête, pied de page, contact).</p>
  </div>

  <form method="POST" action="<?= BASE_PATH ?>/admin/parametres" class="space-y-6">
    <?= Csrf::field() ?>

    <div class="card card-md">
      <h2 class="font-bold text-ink mb-4">Identité</h2>
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-semibold text-ink mb-1.5">Nom du commerce</label>
          <input type="text" name="shop_name" required value="<?= htmlspecialchars($shop['name']) ?>"
                 class="form-input">
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-semibold text-ink mb-1.5">Téléphone</label>
            <input type="text" name="shop_phone" value="<?= htmlspecialchars($shop['phone']) ?>"
                   class="form-input">
          </div>
          <div>
            <label class="block text-sm font-semibold text-ink mb-1.5">E-mail</label>
            <input type="email" name="shop_email" required value="<?= htmlspecialchars($shop['email']) ?>"
                   class="form-input">
          </div>
        </div>
      </div>
    </div>

    <div class="card card-md">
      <h2 class="font-bold text-ink mb-4">Adresse &amp; localisation</h2>
      <div class="space-y-4">
        <div>
          <label class="block text-sm font-semibold text-ink mb-1.5">Adresse</label>
          <input type="text" name="shop_address" value="<?= htmlspecialchars($shop['address']) ?>"
                 class="form-input">
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-semibold text-ink mb-1.5">Code postal</label>
            <input type="text" name="shop_zipcode" value="<?= htmlspecialchars($shop['zipcode']) ?>"
                   class="form-input">
          </div>
          <div>
            <label class="block text-sm font-semibold text-ink mb-1.5">Ville</label>
            <input type="text" name="shop_city" value="<?= htmlspecialchars($shop['city']) ?>"
                   class="form-input">
          </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-semibold text-ink mb-1.5">Latitude <span class="text-gray-400 font-normal">(zonage & proximité)</span></label>
            <input type="text" name="latitude" value="<?= htmlspecialchars($shop['latitude']) ?>"
                   class="form-input">
          </div>
          <div>
            <label class="block text-sm font-semibold text-ink mb-1.5">Longitude</label>
            <input type="text" name="longitude" value="<?= htmlspecialchars($shop['longitude']) ?>"
                   class="form-input">
          </div>
        </div>
      </div>
    </div>

    <div class="card card-md">
      <h2 class="font-bold text-ink mb-4">Horaires d'ouverture</h2>
      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-semibold text-ink mb-1.5">Lundi au Samedi</label>
          <input type="text" name="hours_lun_sam" value="<?= htmlspecialchars($shop['hours']['lun_sam']) ?>"
                 class="form-input">
        </div>
        <div>
          <label class="block text-sm font-semibold text-ink mb-1.5">Dimanche</label>
          <input type="text" name="hours_dim" value="<?= htmlspecialchars($shop['hours']['dim']) ?>"
                 class="form-input">
        </div>
      </div>
    </div>

    <div class="card card-md">
      <h2 class="font-bold text-ink mb-4">Réseaux sociaux</h2>
      <div class="grid sm:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-semibold text-ink mb-1.5">Facebook</label>
          <input type="url" name="social_facebook" value="<?= htmlspecialchars($shop['social']['facebook']) ?>"
                 class="form-input">
        </div>
        <div>
          <label class="block text-sm font-semibold text-ink mb-1.5">Instagram</label>
          <input type="url" name="social_instagram" value="<?= htmlspecialchars($shop['social']['instagram']) ?>"
                 class="form-input">
        </div>
      </div>
    </div>

    <button type="submit" class="btn-primary w-full">
      Enregistrer les modifications
    </button>
  </form>
</div>
