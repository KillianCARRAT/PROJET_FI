<?php

spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/';
    $file = $baseDir . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        error_log("Autoloader : Impossible de charger la classe $class. Fichier $file introuvable.");
        die("Erreur : Classe $class introuvable.");
    }
});