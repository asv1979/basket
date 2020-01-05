<?php
/**
 * @author Alexey Vasilyev <asv2108@gmail.com>
 */
namespace App\components;
/**
 * Prepare a session array for basket values
 *
 * Trait SessionBasketInit
 */
trait SessionBasketInit
{
    /**
     * @return bool
     */
    public function createBasketSessionContainer(){
        if (!isset($_SESSION['productInBasket'])) {
            $_SESSION['productInBasket'] = [];
        }

        return true;
    }
}