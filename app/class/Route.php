<?php

namespace MyFortniteBundle;

use MyFortniteBundle\Helper as Helper;

class Route
{
  private $requestUrl;
  private $routes = [
      'index' => 'indexController.php',
      'test' => 'testController.php',
      'register' => 'registerController.php',
      'newpointer' => 'newPointerController.php',
      'xhr' => 'xhr.php',
  ];

  public function __construct()
  {
//    $requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $requestUrl = $_SERVER['REQUEST_URI'];
    $splittedRequest = explode('/', $requestUrl);
    $this->requestUrl = $splittedRequest[1];
  }

  public function run()
  {
      global $DBH;// Иначе DBH в контроллере будет null
    if ($this->requestUrl == "") {
        //Главная страница
      require_once ROOT . '/app/controller/indexController.php';
      exit;
    }
    // Иначе ищем страницу в массиве $routes
    foreach ($this->routes as $key => $route)
    {
        //echo "key: {$key}, req_url: {$this->requestUrl}, result: " . strpos($key, $this->requestUrl) ."<br>";
      if ( strpos( $key, $this->requestUrl ) !== false ) {
         include ROOT . '/app/controller/' . $route;
        exit;
      }
    }
    Helper::get404();
  }
}