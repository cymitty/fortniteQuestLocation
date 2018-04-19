<?php
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/classes/AbiturientDataGateway.php';
require_once __DIR__ . '/../app/classes/Abiturient.php';
require_once ROOT . '/classes/Pager.php';
require_once ROOT . '/classes/Helper.php';
use StudentList\Helper as Helper;

$search = array_key_exists('search', $_GET) ? $_GET['search'] : '';
$order = array_key_exists('order', $_GET) ? $_GET['order'] : 'points';// По дефолту сортируем по ЕГЭ
$sort = array_key_exists('sort', $_GET) ? $_GET['sort'] : 'desc';
$abiturientGateway = new \StudentList\AbiturientDataGateway($DBH);
//$abiturients = new \StudentList\Abiturient();
$pageNumber = intval( array_key_exists('page', $_GET) ? $_GET['page'] : 1 );
if ($pageNumber > 0)
{
  $offset = ($pageNumber - 1) * 10 ;
  $abiturients = $abiturientGateway->getAbiturientsByQuery($search, 10, $offset, $order, $sort);
} else {
  $abiturients = $abiturientGateway->getAbiturientsByQuery($search);
}



$OrderNameLink = Helper::getSortingLink($search, 'search', 'name', $sort);
$OrderLastNameLink = Helper::getSortingLink($search, 'search', 'lastname', $sort);
$OrderBirthYearLink = Helper::getSortingLink($search, 'search', 'birthyear', $sort);
$OrderGroupNumberLink = Helper::getSortingLink($search, 'search', 'groupnumber', $sort);
$OrderPointsLink = Helper::getSortingLink($search, 'search', 'points', $sort);

$reverseSort = ($sort == 'asc' ? 'desc' : 'asc');
$SortNameLink = Helper::getSortingLinkBySort('search', 'name', $reverseSort);
$SortLastNameLink = Helper::getSortingLinkBySort('search', 'lastname', $reverseSort);
$SortBirthYearLink = Helper::getSortingLinkBySort('search', 'birthyear', $reverseSort);
$SortGroupNumberLink = Helper::getSortingLinkBySort('search', 'groupnumber', $reverseSort);
$SortPointsLink = Helper::getSortingLinkBySort('search', 'points', $reverseSort);

$link = Helper::getSortingLink($search, 'search', $order, $sort);
$pager = new \StudentList\Pager( $abiturientGateway->getAbiturientCountByQuery($search) , 5, "{$link}&page={page}");
$pages = $pager->build();

require_once ROOT . '/views/templates/header.php';
require_once ROOT . '/views/abiturientList.php';
require_once ROOT . '/views/templates/footer.php';
