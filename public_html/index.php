<?php
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/classes/AbiturientDataGateway.php';
require_once __DIR__ . '/../app/classes/Abiturient.php';
require_once __DIR__ . '/../app/classes/AbiturientValidator.php';
require_once ROOT . '/classes/Helper.php';
require_once ROOT . '/classes/Pager.php';
use StudentList\Helper as Helper;
$frontPage = true;
$abiturientGateway = new \StudentList\AbiturientDataGateway($DBH);
$validator = new \StudentList\AbiturientValidator($abiturientGateway);

$notifiesText = [
    'registered' => '<p>Вы успешно зарегистрировались в списке абитуриентов.</p>',
    'updated' => '<p>Информация была обновлена</p>'
];
$notify = array_key_exists('notify', $_GET) ? $_GET['notify']: '';
$notifies = [];
if ( !empty($notify) )
{
  $notifies[] = array_key_exists($notify, $notifiesText) ? $notifiesText[$notify] : '';
}

$pageNumber = intval( array_key_exists('page', $_GET) ? $_GET['page']: 1 );
if ($pageNumber > 0)
{
  $offset = ($pageNumber - 1) * 10 ;
  $abiturients = $abiturientGateway->getAbiturients(10, $offset);
} else {
  $abiturients = $abiturientGateway->getAbiturients(10, 0);
}

$sort = array_key_exists('sort', $_GET) ? $_GET['sort'] : 'asc';
$OrderNameLink = Helper::getSortingLinkByOrder('search', 'name', $sort);
$OrderLastNameLink = Helper::getSortingLinkByOrder('search', 'lastname', $sort);
$OrderBirthYearLink = Helper::getSortingLinkByOrder('search', 'birthyear', $sort);
$OrderGroupNumberLink = Helper::getSortingLinkByOrder('search', 'groupnumber', $sort);
$OrderPointsLink = Helper::getSortingLinkByOrder( 'search', 'points', $sort);

$reverseSort = ($sort == 'asc' ? 'desc' : 'asc');
$SortNameLink = Helper::getSortingLinkBySort('search', 'name', $reverseSort);
$SortLastNameLink = Helper::getSortingLinkBySort('search', 'lastname', $reverseSort);
$SortBirthYearLink = Helper::getSortingLinkBySort('search', 'birthyear', $reverseSort);
$SortGroupNumberLink = Helper::getSortingLinkBySort('search', 'groupnumber', $reverseSort);
$SortPointsLink = Helper::getSortingLinkBySort('search', 'points', $reverseSort);

$pager = new \StudentList\Pager($abiturientGateway->getAbiturientCount(), 10, 'index.php?page={page}');
$pages = $pager->build();
//$AbiturientList = $gateway->getAllAbiturients();

require_once ROOT . '/views/templates/header.php';
require_once ROOT . '/views/abiturientList.php';
require_once ROOT . '/views/templates/footer.php';



