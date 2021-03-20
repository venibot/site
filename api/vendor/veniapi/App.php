<?php

namespace api;

class App {

    protected static $query;

    public function __construct($query) {
        self::$query = $query;
        echo self::$query;
    }

}