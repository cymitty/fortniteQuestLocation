<?php

namespace MyFortniteBundle;

use \MyFortniteBundle\Helper as Helper;

class Route
{
    private $request;// разбитый с помощью parse_url()
    private $requestPath;
    private $requestParameters;
    private $action;
    private $controller;
    private $routes = [
        // ссылка контроллера => Путь к контроллеру без Controller.php
        // '/' => 'newIndex' дефолтный контроллер
        'test' => 'test',
        'register' => 'register',
        'newpointer' => 'newOfferingPointer',
        'xhr' => 'xhr',
        'admin' => 'admin',

    ];

  public function __construct()
  {
      $this->request = parse_url( Registry::instance()->getData('request') );
      $this->requestPath = $this->request['path'];
      $this->controller = explode("/",$this->request['path'])[1];
      parse_str($this->request['query'], $this->requestParameters);
  }

  protected function getActionName($controllerName)
  {
      if ($this->action) return $this->action;
      $action = explode("/",$this->request['path'])[2];
      $action = ($action == "") ? "index" : $action;
      if ( ! method_exists($controllerName, $action)){
          $action = "index";
      }
      $this->action = $action;
      return $this->action;
  }

  protected function getControllerName() {
      return $this->controller;
  }

  protected function runController(): bool
  {
      if ($this->requestPath == "/" || mb_strpos($this->requestPath, 'index')) {
          //Главная страница
          include ROOT . '/app/controller/indexController.php';
          $controller = new \indexController();
          $action = $this->getActionName($controller);
          $controller->$action($this->requestParameters);
          exit;
      }
      // Иначе ищем страницу в массиве $routes
      foreach ($this->routes as $key => $route)
      {
          if ( mb_strpos($this->getControllerName(), $key ) !== false ) {
              include ROOT . '/app/controller/' . $route . 'Controller.php';
              $classController = $route . "Controller";
              $controller = new $classController();
              $action = $this->getActionName($controller);
              $controller->$action($this->requestParameters);
              exit;
          }
      }
      return false;
  }

  public function run()
  {
      $this->runController();
  }
}