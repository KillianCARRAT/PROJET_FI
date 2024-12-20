<?php

namespace Src\Controllers;

class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection === null) {
            try {
                self::$connection = new \PDO('mysql:host=servinfo-maria;dbname=DBlepage', 'lepage', 'lepage');
                self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                error_log('Erreur de connexion : ' . $e->getMessage());
                die('Erreur de connexion à la base de données.');
            }
        }
        return self::$connection;
    }
}
