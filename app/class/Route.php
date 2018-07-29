<?php

namespace MyFortniteBundle;

use MyFortniteBundle\Helper as Helper;

class Route
{
    public $requestUrl;
  private $requestPath;
  private $requestParameters;
  private $routes = [
      'index' => 'indexController.php',
      'test' => 'testController.php',
      'register' => 'registerController.php',
      'newpointer' => 'newOfferingPointerController.php',
      'xhr' => 'xhr.php',
      'admin' => 'adminController.php'
  ];

  public function __construct()
  {
      global $requestUrl;
      $this->requestUrl = $requestUrl;
      var_dump($requestUrl);
      $this->requestPath = $requestUrl['path'];
//      parse_str($requestUrl['query'], $this->requestParameters);
  }

  public function run()
  {
      global $DBH;// Иначе DBH в контроллере будет null
      global $requestUrl;
    if ($this->requestPath == "") {
        //Главная страница
      require_once ROOT . '/app/controller/indexController.php';
      exit;
    }
    // Иначе ищем страницу в массиве $routes
    foreach ($this->routes as $key => $route)
    {
      if ( mb_strpos($this->requestPath, $key ) !== false ) {
         include ROOT . '/app/controller/' . $route;
        exit;
      }
    }
    Helper::get404();
  }
}