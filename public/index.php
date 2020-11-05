<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_save_path('/usr/local/var/tmp');
session_start();

require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once ROOT ."/Routes.php";