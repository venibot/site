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
            $controller = "app\controllers\\" . self::$route['controller'] . "Controller";
            if (!class_exists($controller)) {
                throw new \Exception("Not found", 404);
            } else {
                $controllerObject = $controller(self::$route);
                $action = self::$route['action'];
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
                $route['controller'] = self::camelCase($route['controller'], true);
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