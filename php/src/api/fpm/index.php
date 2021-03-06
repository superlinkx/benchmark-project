<?php
require_once(__DIR__ . "/router.php");
// Functions
require_once(__DIR__ . "/../../functions/concat.php");
require_once(__DIR__ . "/../../functions/counter.php");
require_once(__DIR__ . "/../../functions/arrayfill.php");
require_once(__DIR__ . "/../../functions/mapfill.php");
require_once(__DIR__ . "/../../functions/jsondecode.php");
require_once(__DIR__ . "/../../functions/fileread.php");

use Application\Router;

// Setup
$jsonPath = __DIR__ . "/data/demo.json";
$fp = fopen($jsonPath, "r");
$jsonData = fread($fp, filesize($jsonPath));
fclose($fp);

// Router
$router = new Router();
$router
  ->add404Handler(function () {
    http_response_code(404);
    return ["error" => "Route Not Found"];
  })
  ->addRoute("/", function () {
    return ["data" => "Hello World"];
  })
  ->addRoute("/concat", function () {
    return ["data" => concat()];
  })
  ->addRoute("/counter", function () {
    return ["data" => counter()];
  })
  ->addRoute("/arrayfill", function () {
    return ["data" => arrayfill()];
  })
  ->addRoute("/mapfill", function () {
    return ["data" => mapfill()];
  })
  ->addRoute("/jsondecode", function () {
    global $jsonData;
    return ["data" => jsondecode($jsonData)];
  })
  ->addRoute("/fileread", function () {
    return ["data" => fileread(__DIR__ . "/../../data/demo.txt")];
  });

$router->handle();
