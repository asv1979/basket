<?php
namespace App\components;

use App\controllers\IndexController;

class Router
{

    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/app/config/routes.php';
        $this->routes = include($routesPath);
    }


    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~$uriPattern~", $uri) && $uri !== 'favicon.ico') {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parameters = $segments;

                $controllerFile = ROOT . '/controllers/' .$controllerName. '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                $project_name = '\App';
                $package_name = 'controllers';
                $full_class_name = $project_name . '\\' . $package_name . '\\' . $controllerName;
                $controllerObject = new  $full_class_name();


                /*$result = $controllerObject->$actionName($parameters); - OLD VERSION */

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null) {
                    break;
                }
            }

        }
    }
}