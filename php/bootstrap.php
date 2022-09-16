<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Allow: *");
$method = $_SERVER['REQUEST_METHOD'];
if ($method === "OPTIONS") {
    die();
}

session_start();

require_once "vendor/autoload.php";
require_once "dbconection.php";

header("Content-Type: application/json");

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();