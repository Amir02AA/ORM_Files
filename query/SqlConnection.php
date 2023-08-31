<?php
namespace query;
use PDO;

class SqlConnection
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (!self::$pdo) {
            $dsn = "mysql:host=localhost;dbname=eloquent";
            $user = 'root';
            $password = '';

            self::$pdo = new PDO($dsn, $user, $password);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        }
        return self::$pdo;
    }

}
