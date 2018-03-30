<?php

namespace StudentList;


class Route
{
  private $requestUrl;
  private $routes = [
      '' => 'main.html',
      'register' => 'register.php'
  ];

  public function __construct()
  {
    //$requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $requestUrl = $_SERVER['REQUEST_URI'];
    $splittedRequest = explode('/', $requestUrl);
    $this->requestUrl = $splittedRequest[1];
  }

  public function run()
  {
    foreach ($this->routes as $key => $route)
    {
      if ( strpos( $key, $this->requestUrl ) != 'FALSE' )
      {
        require_once ROOT . '/../public_html/' . $route;
        exit;
      }
    }
    Helper::get404();
  }
}