<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body<?= isset($bodyClass) ? " class=\"$bodyClass\"" : '' ?>>
<?= $content ?>
<?php require __DIR__ . '/partials/modal-error.php'; ?>
<?php require __DIR__ . '/partials/modal-confirm.php'; ?>
<?php if (!empty($charts)): ?>
  <script src="presentation/assets/js/vendor/chart.umd.min.js"></script>
<?php endif; ?>
  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
