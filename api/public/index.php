<?php
require_once dirname(__DIR__) . '/config/config.php';

$query = &$_SERVER['QUERY_STRING'];
new api\App($query);