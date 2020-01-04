<?php
/**
 * Routing.
 *
 * @author Alexey Vasilyev <asv2108@gmail.com>
 */

namespace App\components;

/**
 * Class Router
 */
class Router
{
    /**
     * @var mixed
     */
    private $_routes;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->_routes = include_once(ROOT . '/app/config/routes.php');
    }

    /**
     * Get http uri
     *
     * @return string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * Consider uri get a need controller
     */
    public function run()
    {
        $uri = $this->getURI();
        $result = null;

        foreach ($this->_routes as $uriPattern => $path) {

            if ($uriPattern === $uri) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;

                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if (file_exists($controllerFile))
                {
                    include_once ($controllerFile);
                }

                $full_class_name = '\App\\controllers\\' . $controllerName;
                $controllerObject = new  $full_class_name();

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null) {
                    break;
                }
            }
        }
        if ($result === null && !isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $uri !== 'favicon.ico') {
            include_once(ROOT . '/public/404.phtml');
        }

        return true;
    }
}
