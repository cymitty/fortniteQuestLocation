<?php

namespace StudentList;

// Вспомогательные static functions ( инициализировать класс не требуется )
class Helper
{
  public static function get404()
  {
    require_once ROOT . '/../public_html/404.html';
    /* Убедиться, что код ниже не выполнится после перенаправления .*/
    exit;
  }
}