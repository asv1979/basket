<?php
namespace App\components;

/**
 * Class Db
 *
 * @package App\components
 */
class Db
{

    /**
     * @return PDO
     */
    public static function getConnection()
    {
        $dbConfig = parse_ini_file(ROOT . "/app/config/config.ini");

        $dsn = 'mysql:host=' . $dbConfig['DB_HOST'] . ';dbname=' . $dbConfig['DB_NAME'];
        $db = new PDO($dsn, $dbConfig['DB_USER'], $dbConfig['DB__PASSWORD']);
        $db->exec("set names utf8");

        return $db;
    }
}
