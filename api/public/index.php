<?php
require_once dirname(__DIR__) . '/config/config.php';

$query = strtok($_SERVER['QUERY_STRING'], '&');
$query = trim($query, '/');
$key = trim($_GET['key'] != null ? $_GET['key'] : $_POST['key']);

new api\App($query, $key);