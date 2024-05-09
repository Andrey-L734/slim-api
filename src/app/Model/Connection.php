<?php

namespace App\Model;

use PDO;

class Connection
{
    private static PDO $pdo;

    public static function init(): void
    {
        $driver = 'mysql';
        $host = 'mysql';
        $dbName = 'slim_api';
        $user = 'root';
        $password = 'mysql';

        self::$pdo = new \PDO("$driver:host=$host; dbname=$dbName",$user, $password);
    }

    public static function getPdo(): PDO
    {
        return self::$pdo;
    }
}