<?php

class Db
{
    private static ?Db $db = null;

    private PDO $connection;

    private function __construct()
    {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        $connection = new PDO($dsn, DB_USER, DB_PASS);
        $connection->exec("set names utf8");

        $this->connection = $connection;
    }

    public static function getConnection(): PDO
    {
        if (self::$db === null) {
            self::$db = new Db();
        }

        return self::$db->connection;
    }
}
