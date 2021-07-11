<?php
require_once(__DIR__ . "/router.php");
// Functions
require_once(__DIR__ . "/../../functions/concat.php");
require_once(__DIR__ . "/../../functions/counter.php");
require_once(__DIR__ . "/../../functions/arrayfill.php");
require_once(__DIR__ . "/../../functions/mapfill.php");
require_once(__DIR__ . "/../../functions/fileread.php");

use Application\Router;

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
  ->addRoute("/fileread", function () {
    return ["data" => fileread()];
  });

$router->handle();
