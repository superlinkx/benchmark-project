<?php

namespace Application;

use Swoole\Http\Request;
use Swoole\Http\Response;

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
  public function handle(Request $req, Response $res)
  {
    if (isset($this->routes[$req->server['request_uri']])) {
      $res->status(200);
      $res->header('Content-Type', 'application/json');
      $res->end(json_encode($this->routes[$req->server['request_uri']]()));
    } else {
      $res->status(404);
      $res->header('Content-Type', 'application/json');
      $res->end(json_encode($this->routes['404']()));
    }
  }
}
