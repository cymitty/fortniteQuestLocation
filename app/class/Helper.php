<?php

namespace MyFortniteBundle;
use MyFortniteBundle\Quest;
// Вспомогательные static functions ( инициализировать класс не требуется )
class Helper
{

    public static function buildQuestsTree(array &$quests)
    {
        $tree = [];
        // Сортировка по полю неделя ( возрастание )
        usort($quests, function (Quest $a, Quest $b) {
            if ($a->getWeek() == $b->getWeek()) {
                return 0;
            }
            return ($a->getWeek() < $b->getWeek()) ? -1 : 1;
        });

        foreach ($quests as $quest) {
            $tree[] = [
                'id'    => $quest->getId(),
                'name'  => $quest->getName(),
                'week'  => $quest->getWeek(),
            ];
        }

        return $tree ?? false;
    }

    public static function isXMLHttpRequest()
    {
        if ($_SERVER['CONTENT_TYPE'] == 'application/json')
            return true;
    }

    public static function getXMLHttpRequestData()
    {
        return file_get_contents('php://input');
    }

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
      header("Location: http://{$_SERVER['HTTP_HOST']}/404.html");
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

  public static function generateOffset($pageNumber, $recordsPerPage)
  {
    if  ($pageNumber > 0) {
      $result = ($pageNumber - 1) * $recordsPerPage ;
      return $result;
    }
    return 0;// Иначе показываем первую страницу
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