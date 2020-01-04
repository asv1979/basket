<?php
/**
 * @author Alexey Vasilyev <asv2108@gmail.com>
 */

namespace App\controllers;

session_start();

use App\models\Product;
use App\components\Layout;

/**
 * Class BasketController
 */
class BasketController
{
    /**
     *  Include main html template
     */
    use Layout;

    /**
     * Show user selected products
     *
     * @return bool
     */
    public function actionIndex()
    {
        $params['view'] = 'basket/index';
        $params['title'] = 'My basket page';
        $params['args'] = $_SESSION['productInBasket'] ?? [];
        $this->getLayout($params);
        return true;
    }

    /**
     * Js call it
     */
    public function actionAdd()
    {
        $answer = [];
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        ) {

            $productData = $this->_preprocessData($_POST);
            $res = $this->_addProductToSession($productData);
            if ($res === 'success') {
                $answer['success'] = true;
            } else {
                $lastChoice = array_pop($_SESSION['productInBasket']);
                $answer['success'] = false;
                $answer['message'] = $res;
            }
        } else {
            $answer['success'] = false;
            $answer['message'] = "Not ajax or empty/not correct data";
        }
        $myJSON = json_encode($answer);

        echo $myJSON;
    }

    public function actionDelete()
    {
        $answer = [];
        if (
            isset($_SERVER['HTTP_X_REQUESTED_WITH'])
            && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        ) {

            $productData = $this->_preprocessData($_POST);
            $res = $this->_deleteProductFromSession($productData);
            if ($res === 'success') {
                $answer['success'] = true;
            } else {
                $answer['success'] = false;
                $answer['message'] = $res;
            }
        } else {
            $answer['success'] = false;
            $answer['message'] = "Not ajax or empty/not correct data";
        }
        $myJSON = json_encode($answer);

        echo $myJSON;
    }

    /**
     * Put selected product to session
     * and reservation of goods
     *
     * @param array $data
     *
     * @return string
     */
    private function _addProductToSession($data)
    {
        if (!isset($_SESSION['productInBasket'])) {
            $_SESSION['productInBasket'] = [];
        }
        if (array_push($_SESSION['productInBasket'], $data)) {
            return Product::decreaseQuantity($data);
        } else {
            $lastChoice = array_pop($_SESSION['productInBasket']);
            return 'Sorry, problem with adding your choice - ' . $lastChoice['name'];
        }
    }

    /**
     * @param $data
     * @return mixed|string
     */
    private function _deleteProductFromSession($data)
    {
        if ($_SESSION['productInBasket']) {

            $message = Product::increaseQuantity($data);;
            foreach ($_SESSION['productInBasket'] as $k => $v) {
                if ($v['name'] == $data['name']) {
                    unset($_SESSION['productInBasket'][$k]);
                    break;
                }
            }
            return $message;
        }
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    private function _preprocessData($data)
    {
        foreach ($data as $k => &$v) {
            switch ($k) {
                case 'id':
                    $v = (int)$v;
                    break;
                case 'price':
                    $v = (float)$v;
                    break;
                case 'name':
                    $v = trim(htmlentities(strip_tags($v)));
                    break;
            }
        }

        return $data;
    }
}
