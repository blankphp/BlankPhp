<?php


namespace Blankphp\Database;


class DbConnect
{
    private static $pdo;

    public static function pdo(array $db)
    {
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        try {
            $dsn = sprintf('%s:host=%s;dbname=%s;charset=%s',
                $db['driver'], $db['host'], $db['database'], $db['charset']);
            $option = array(\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC);
            return self::$pdo = new \PDO($dsn, $db['username'], $db['password'], $option);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public static function getPdo()
    {
        return self::$pdo;
    }

}