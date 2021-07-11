<?php

namespace Application;

class Router
{
  private $routes = [];
  function __construct()
  {
    $this->routes['404'] = function () {
      return ["error" => "Resource Not Found"];
    };
  }

  public function add404Handler($handler)
  {
    $this->routes['404'] = $handler;
    return $this;
  }
  public function addRoute($name, $handler)
  {
    $this->routes[$name] = $handler;
    return $this;
  }
  public function handle()
  {
    $uriString = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (isset($this->routes[$uriString])) {
      http_response_code(200);
      header('Content-Type: application/json');
      print(json_encode($this->routes[$uriString]()));
    } else {
      http_response_code(404);
      header('Content-Type: application/json');
      print(json_encode($this->routes['404']()));
    }
  }
}
