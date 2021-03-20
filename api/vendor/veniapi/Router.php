<?php


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

    public static function matchRoute($query) {
        foreach (self::$routes as $regex => $route) {
            if (preg_match($regex, $query)) {
                return $route;
            }
        }
        return false;
    }

}