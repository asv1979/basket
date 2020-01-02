<?php
namespace App\controllers;


class IndexController
{
    public function actionIndex()
    {
        $test = 'Hello world';
        $viewName = 'index/index';
        $params['view'] = $viewName;
        $params['args'] = $test;
        $this->getLayout($params);
        return true;
    }

    public function actionView($id)
    {
        return true;
    }

    private function getLayout($params){
        $viewName = $params['view'];
        $args= $params['args'];
        require_once(ROOT . '/app/views/layout.phtml');
    }
}
