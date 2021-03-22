<?php
require_once dirname(__DIR__) . '/config/config.php';

$query = trim($_SERVER['QUERY_STRING'], '/');
$key = trim($_GET['key']);

new api\App($query, $key);