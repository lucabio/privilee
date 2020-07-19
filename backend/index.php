<?php

require __DIR__ . '/vendor/autoload.php';

use Src\ProcessRequest;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if ($uri[1] !== 'get-data') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$name = null;
if (isset($uri[2])) {
    $name = $uri[2];
}

$discount = null;
if (isset($uri[3])) {
    $discount = $uri[3];
}

header($response['status_code_header']);

$pr = new ProcessRequest();
$pr->getData($name,$discount);

?>