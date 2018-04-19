<?php

namespace StudentList;

// Вспомогательные static functions ( инициализировать класс не требуется )
class Helper
{
  public static function getHeader()
  {
    require_once ROOT . '/views/templates/header.php';
  }
  public static function getFooter()
  {
    require_once ROOT . '/views/templates/footer.php';
    die();
  }
  public static function get404()
  {
    require_once ROOT . '/../public_html/404.html';
    /* Убедиться, что код ниже не выполнится после перенаправления .*/
    die();
  }

  public static function generateCookiePassword() {
    $string = base64_encode( random_bytes(10) );
    $result = password_hash( $string, PASSWORD_DEFAULT );
    return $result;
  }

  public static function getSortingLink( $search, $dir, $order = '', $sort = 'asc' )
  {
    $link = '' . $dir . '.php?' . http_build_query([
            'search' => $search,
            'order' => $order,
            'sort' => $sort
        ]);
    return $link;
  }

  public static function getSortingLinkByOrder($dir, $order, $sort)
  {
    $link = '' . $dir . '.php?' . http_build_query([
            'order' => $order,
            'sort'  => $sort
        ]);
    return $link;
  }

  public static function getSortingLinkBySort($dir, $order, $sort)
  {
    $link = '' . $dir . '.php?' . http_build_query([
            'order' => $order,
            'sort' => $sort
        ]);
    return $link;
  }

  /*
   * Возвращает количество абитуриентов по массиву полученному из getAbiturientsByQuery()
   */
  public static function getAbiturientsCount($abiturients)
  {
    $result = count( $abiturients );
    return $result;
  }
}