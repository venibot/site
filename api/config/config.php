<?php

define("DEBUG", 0);
define("ROOT", dirname(__DIR__));
define("PUBLIC", ROOT . "/public");
define("CORE", ROOT . '/vendor/veniapi');
define("LOG_FILE", ROOT . '/tmp/error.log');

$dbConfig = require_once 'db.php';
$uri = "mongodb://" . $dbConfig['host'] . ":" . $dbConfig['port'];
define("MONGO_URI", $uri);
define("MONGO_CONFIG", $dbConfig);

require_once CORE . '/libs/functions.php';
require_once ROOT . '/vendor/autoload.php';