<?php use App\Core\Csrf; ?>

<div class="w-full max-w-md bg-white border border-gray-100 rounded-2xl shadow-sm p-8">
  <h1 class="font-extrabold text-2xl text-ink mb-1">Connexion</h1>
  <p class="text-gray-500 text-sm mb-6">Accédez à votre portefeuille et vos avantages fidélité.</p>

  <?php if ($error): ?>
    <div class="flex items-start gap-2 bg-brand-50 text-brand-700 border border-brand-100 rounded-lg px-4 py-3 text-sm mb-5">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" d="M12 8v5M12 16h.01"/></svg>
      <?= htmlspecialchars($error) ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="<?= BASE_PATH ?>/connexion" class="space-y-4">
    <?= Csrf::field() ?>

    <div>
      <label class="block text-sm font-semibold text-ink mb-1.5">Numéro WhatsApp</label>
      <input type="tel" name="phone_whatsapp" required autofocus placeholder="06 12 34 56 78"
             value="<?= htmlspecialchars($old['phone'] ?? '') ?>"
             class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30 focus:border-brand-500">
    </div>

    <div>
      <label class="block text-sm font-semibold text-ink mb-1.5">Mot de passe</label>
      <input type="password" name="password" required placeholder="••••••••"
             class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/30 focus:border-brand-500">
    </div>

    <button type="submit" class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm px-6 py-3.5 rounded-lg transition-colors">
      Se connecter
    </button>
  </form>

  <p class="text-center text-sm text-gray-500 mt-6">
    Pas encore de compte ?
    <a href="<?= BASE_PATH ?>/inscription" class="text-brand-500 font-semibold hover:underline">Créer un compte</a>
  </p>
</div>
