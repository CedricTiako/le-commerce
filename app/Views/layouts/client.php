<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($title ?? $shop['name']) ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Pacifico&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/app.css">
</head>
<body class="bg-gray-50 text-ink antialiased font-sans">

<?php require __DIR__ . '/../partials/header.php'; ?>
<?php require __DIR__ . '/../partials/flash.php'; ?>

<div class="max-w-[1536px] mx-auto px-6 lg:px-10 py-8 grid lg:grid-cols-[260px_1fr] gap-6">
  <?php require __DIR__ . '/../partials/client-sidebar.php'; ?>
  <div class="min-w-0">
    <?= $content ?>
  </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
<?php require __DIR__ . '/../partials/proximity-widget.php'; ?>

<script src="<?= BASE_PATH ?>/assets/js/app.js"></script>
</body>
</html>
