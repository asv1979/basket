<?php
/**
 *  @author Alexey Vasilyev <asv2108@gmail.com>
 */
namespace App\components;

/**
 * Class Db
 */
class Db
{

    /**
     * Get db connection/
     *
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
