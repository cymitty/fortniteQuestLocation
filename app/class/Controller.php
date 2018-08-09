<?php
/**
 * Created by PhpStorm.
 * User: amitty
 * Date: 8/9/2018
 * Time: 6:04 PM
 */

namespace MyFortniteBundle;

abstract class Controller
{
    abstract protected function index();

    public function view(string $path, $vars = array())
    {
        $data = $vars;// Переданные переменные
        if (file_exists(VIEW . "/" . $path)) {
            include_once VIEW . "/" . $path;
        } else {
            echo "Файл представления не существует, либо не доступен для чтения";
        }
    }
}