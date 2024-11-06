<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <?php foreach ($lesCSS as $css): ?>
        <link rel="stylesheet" href="/PROJET_FI/public/assets/css/<?php echo $css; ?>.css">
    <?php endforeach; ?>
    <title><?php echo $title ?? 'Mon Site'; ?></title>
</head>