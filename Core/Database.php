<?php

namespace App\Core;

class Database
{

    public static $pdo;

    public function __construct()
    {
        try {
            Database::$pdo = new \PDO("mysql:host=localhost;dbname=e_co", "root", "");
            Database::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $err) {
            echo $err;
        }
    }

    public static function query(string $query, array $params = null): array
    {
        $statement = Database::$pdo->prepare($query);
        $statement->execute($params);
        $res = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $res;
    }
}
