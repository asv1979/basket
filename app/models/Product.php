<?php
/**
 * Class for work with product table
 *
 * @author Alexey Vasilyev <asv2108@gmail.com>
 */

namespace App\models;

use App\components\Db;
use PDO;

/**
 * Get from the product table need data
 *
 * Class Product
 * @package App\models
 */
class Product
{
    /**
     * Get a selected product
     *
     * @param $id
     *
     * @return mixed
     */
    public static function getItemByID($id)
    {
        $id = (int)$id;
        if ($id) {
            $db = Db::getConnection();
            $result = $db->query('SELECT * FROM products WHERE id=' . $id);

            $result->setFetchMode(PDO::FETCH_ASSOC);

            return $result->fetch();
        }

        return false;
    }

    /**
     * Returns an array of available products
     *
     * @return array
     */
    public static function getList()
    {
        $db = Db::getConnection();
        $list = [];

        $result = $db->query(
            'SELECT id, `name`, price, quantity FROM products WHERE in_stock = 1 AND quantity IS NOT NULL'
        );

        $i = 0;
        while ($row = $result->fetch()) {
            $list[$i]['id'] = $row['id'];
            $list[$i]['name'] = $row['name'];
            $list[$i]['quantity'] = $row['quantity'];
            $list[$i]['price'] = $row['price'];
            $i++;
        }

        return $list;
    }

    /**
     * Reservation of goods
     *
     * @param array $data
     *
     * @return string
     */
    public static function decreaseQuantity($data)
    {
        $db = Db::getConnection();
        $query = "SELECT quantity FROM products WHERE `name`= ? AND id =? LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bindValue(1, $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(2, $data['id'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $prodQuantity = $stmt->fetch(PDO::FETCH_NUM)[0];
            if ($prodQuantity > 0) {
                if ($prodQuantity != 1) {
                    $db->query('UPDATE products SET quantity = quantity - 1 WHERE id =' . $data['id']);
                } else {
                    $db->query('UPDATE products SET in_stock = 0, quantity = 0 WHERE id =' . $data['id']);
                }
                return 'success';
            } else {
                return 'Sorry, the ' . $data['name'] . ' - is over.';
            }
        } else {
            return 'Sorry, the ' . $data['name'] . ' - does not exist.';
        }
    }

    /**
     * Return reservation product to available
     *
     * @param $data
     *
     * @return mixed|string
     */
    public static function increaseQuantity($data)
    {
        $db = Db::getConnection();
        $query = "SELECT quantity FROM products WHERE `name`= ? AND id =? LIMIT 1";
        $stmt = $db->prepare($query);
        $stmt->bindValue(1, $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(2, $data['id'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            $prodQuantity = $stmt->fetch(PDO::FETCH_NUM)[0];
            if ($prodQuantity > 0) {
                $db->query('UPDATE products SET quantity = quantity + 1 WHERE id =' . $data['id']);

            } else {
                $db->query('UPDATE products SET in_stock = 1, quantity = 1 WHERE id =' . $data['id']);
            }
            if (!$db->errorInfo()[2]) {
                return 'success';
            } else {
                return $db->errorInfo()[2];
            }
        }

        return $db->errorInfo()[2];
    }
}
