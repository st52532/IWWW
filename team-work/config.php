<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'rootHeslo');
define('DB_PASSWORD', 'rootHeslo');
define('DB_NAME', 'user-management');
define('BASE_URL', parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
define('CURRENT_URL', $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING']);