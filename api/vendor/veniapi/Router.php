<?php

namespace api;

class Router {

    protected static $routes = [];

    protected static $route = [];

    public static function addRoute($regex, $route = []) {
        self::$routes[$regex] = $route;
    }

    public static function getRoute() {
        return self::$route;
    }

    public static function getRoutes() {
        return self::$routes;
    }

    public static function processRoute($query) {
        if (self::matchRoute($query)) {
            $controller = "app\controllers\\" . self::$route['service'] . "\\" . self::camelCase(self::$route['controller'], truw) . "Controller";
            if (!class_exists($controller)) {
                throw new \Exception("Not found", 404);
            } else {
                $controllerObject = new $controller(self::$route);
                $action = self::camelCase(self::$route['action']) . "Action";
                debug($action);
                if (!method_exists($controllerObject, $action)) {
                    throw new \Exception("Not found", 404);
                } else {
                    $controllerObject->$action();
                }
            }
         }
    }

    public static function matchRoute($query) {
        foreach (self::$routes as $regex => $route) {
            if (preg_match("#{$regex}#", $query, $matches)) {
                foreach ($matches as $k => $v) {
                    if(is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = "index";
                }
                self::$route = $route;
                return true;
            }
        }
        throw new \Exception("Not found", 404);
        return false;
    }

    private static function camelCase($string, $upperCamelCase = false) {
        $string = str_replace('-', '', ucwords($string, '-'));

        if (!$upperCamelCase) {
            $string = lcfirst($string);
        }

        return $string;
    }

}