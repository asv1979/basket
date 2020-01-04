<?php
/**
 * @author Alexey Vasilyev <asv2108@gmail.com>
 */

namespace App\controllers;

session_start();

use App\components\Layout;
use App\models\Product;

/**
 * Main controller
 *
 * Class IndexController
 */
class IndexController
{
    /**
     *  Include main html template
     */
    use Layout;

    /**
     * Shows main page
     *
     * @return bool
     */
    public function actionIndex()
    {
        $params['view'] = 'index/index';
        $params['title'] = 'Main page';
        $params['args'] = 'Go to shopping!';
        $this->getLayout($params);
        return true;
    }

    /**
     * Shows product detail page.
     *
     * @return bool
     */
    public function actionList()
    {
        $params['view'] = 'index/list';
        $params['title'] = 'List page';
        $params['args'] = Product::getList();
        $params['class'] = $_SESSION['productInBasket'] ? 'show' : 'hide';
        $this->getLayout($params);
        return true;
    }

    /**
     * A detail product page
     *
     * @param int $id
     *
     * @return bool
     */
    public function actionView($id)
    {
        return true;
    }
}
