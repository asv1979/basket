<?php
/**
 *  @author Alexey Vasilyev <asv2108@gmail.com>
 */
namespace App\controllers;

/**
 * Main controller
 *
 * Class IndexController
 */
class IndexController
{
    /**
     * Shows main page
     *
     * @return bool
     */
    public function actionIndex()
    {
        $params['view'] = 'index/index';
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
        $params['args'] = 'Go to shopping!';
        $this->_getLayout($params);
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

    /**
     * Include main html file
     *
     * @param $params
     *
     * @return bool
     */
    private function _getLayout($params)
    {
        $viewName = $params['view'];
        $args = $params['args'];
        included_once(ROOT . '/app/views/layout.phtml');

        return true;
    }
}
