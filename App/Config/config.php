<?php
define('ENV', 'dev');
// define('ENV', 'production');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname($_SERVER["DOCUMENT_ROOT"]));
define('APP', ROOT . DS . 'App');
define('VIEWS', APP . DS . 'Views');
define('PUBLIC_DIR', ROOT . DS . 'pulic');
define('INCLUDES', ROOT . DS . 'includes');
define('UPLOADS', PUBLIC_DIR . DS . 'uploads');

// Database
$dbConfig = [
    'db_name' => 'TDW_MVC-Practice',
    'db_username' => 'root',
    'db_password' => 'Rampage28092560',
];
$selectedDbConfig = $dbConfig;

define('DB_HOST', "localhost");
define('DB_NAME', $selectedDbConfig['db_name']);
define('DB_USERNAME', $selectedDbConfig['db_username']);
define('DB_PASSWORD', $selectedDbConfig['db_password']);

// Optional
date_default_timezone_set('Asia/Bangkok');