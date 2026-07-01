<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($title ?? $shop['name']) ?></title>
<meta name="description" content="<?= htmlspecialchars($shop['name']) ?> — Bar, Tabac, PMU, FDJ, Presse à <?= htmlspecialchars($shop['city']) ?>. Votre commerce de proximité.">

<!-- Polices -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- CSS compilé (Tailwind + DaisyUI, build local via `npm run build`) -->
<link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/app.css">
<style>
  ::-webkit-scrollbar { width: 8px; height: 8px; }
  ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 8px; }
</style>
</head>
<body class="bg-white text-ink antialiased font-sans">

<?php require __DIR__ . '/../partials/header.php'; ?>
<?php require __DIR__ . '/../partials/flash.php'; ?>

<main>
<?= $content ?>
</main>

<?php require __DIR__ . '/../partials/footer.php'; ?>
<?php require __DIR__ . '/../partials/chat-widget.php'; ?>

<script src="<?= BASE_PATH ?>/assets/js/app.js"></script>
</body>
</html>
