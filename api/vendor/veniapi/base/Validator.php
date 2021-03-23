<?php

namespace api\base;

use api\App;

class Validator {

    public static function validateApiKey($apiKey) {
        if ($apiKey == null) {
            throw new \Exception("Unauthorized", 401);
        } else {
            $key = App::getMongoConnection()->venisite->tokens->findOne(['key' => $apiKey]);
            if ($key != null) {
                return true;
            } else {
                throw new \Exception("Invalid API key", 401);
            }
        }
    }

}