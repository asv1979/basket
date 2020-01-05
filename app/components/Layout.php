<?php
/**
 * @author Alexey Vasilyev <asv2108@gmail.com>
 */
namespace App\components;

/**
 * Include main html file
 *
 * Trait Layout
 */
trait Layout
{
    /**
     * Include main html file
     *
     * @param $params
     *
     * @return bool
     */
    protected function getLayout($params)
    {
        $viewName = $params['view'];
        $title =  $params['title'];
        $class = $params['class'] ?? '';
        $args = $params['args'];
        include_once(ROOT . '/app/views/layout.phtml');

        return true;
    }
}
