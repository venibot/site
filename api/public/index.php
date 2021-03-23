<?php
require_once dirname(__DIR__) . '/config/config.php';

$query = trim($_SERVER['QUERY_STRING'], '/');
$key = trim($_GET['key'] != null ? $_GET['key'] : $_POST['key']);

new api\App($query, $key);