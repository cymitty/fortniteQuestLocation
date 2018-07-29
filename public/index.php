<?php
require_once __DIR__ . '/../app/bootstrap.php';
require_once ROOT . "/app/class/Route.php";

$requestUrl = parse_url($_SERVER['REQUEST_URI']);
$router = new \MyFortniteBundle\Route();
$router->run();


//require_once ROOT . '/views/templates/header.php';
//require_once ROOT . '/views/abiturientList.php';
//require_once ROOT . '/views/templates/footer.php';



