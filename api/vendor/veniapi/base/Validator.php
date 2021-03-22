<?php

namespace api\base;

use api\App;

class Validator {

    public static function validateApiKey($apiKey) {
        $key = App::getMongoConnection()->venisite->tokens->findOne(['key' => $apiKey]);
        if ($key != null) {
            echo "Ладно, проходи";
            return true;
        } else {
            echo "Неправильный токен";
            throw new \Exception("Unauthorized", 403);
        }
    }

}