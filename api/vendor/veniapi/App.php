<?php

namespace api;

use MongoDB\Client;

class App {

    protected static $query;

    protected static $apiKey;

    protected static $mongoConnection;

    public function __construct($query, $apiKey) {
        self::$query = $query;
        self::$apiKey = $apiKey;
        new ErrorHandler();
        self::openMongoConnection();
        base\Validator::validateApiKey(self::$apiKey);
    }

    private function openMongoConnection() {
        self::$mongoConnection = new Client(MONGO_URI, [
            'username' => MONGO_CONFIG['user'],
            'password' => MONGO_CONFIG['password'],
            'db' => MONGO_CONFIG['database']
        ]);
    }

    public static function getMongoConnection() {
        return self::$mongoConnection;
    }

}