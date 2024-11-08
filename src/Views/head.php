<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <?php foreach ($lesCSS as $css): ?>
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>/public/assets/css/<?php echo $css; ?>.css">
    <?php endforeach; ?>
    <title><?php echo $title ?? 'Mon Site'; ?></title>
    <?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=projet_fi', 'root', 'carrat');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    ?>
</head>