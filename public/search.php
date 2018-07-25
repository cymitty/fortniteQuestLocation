<?php
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/class/AbiturientDataGateway.php';
require_once __DIR__ . '/../app/class/Abiturient.php';
require_once ROOT . '/classes/Pager.php';
require_once ROOT . '/classes/Helper.php';
use StudentList\Helper as Helper;

$search = array_key_exists('search', $_GET) ? $_GET['search'] : '';
$order = array_key_exists('order', $_GET) ? $_GET['order'] : 'points';// По дефолту сортируем по ЕГЭ
$sort = array_key_exists('sort', $_GET) ? $_GET['sort'] : 'desc';
$abiturientGateway = new \StudentList\AbiturientDataGateway($DBH);
$pageNumber = intval( array_key_exists('page', $_GET) ? $_GET['page'] : 1 );
$offset = Helper::generateOffset($pageNumber, 10);
$abiturients = $abiturientGateway->getAbiturientsByQuery($search, 10, $offset, $order, $sort);



// Ссылки для изменения сортировки таблицы по столбцу ( по имени, по баллам.. )
$OrderNameLink = Helper::getSortingLink($search, 'search', 'name', $sort);
$OrderLastNameLink = Helper::getSortingLink($search, 'search', 'lastname', $sort);
$OrderBirthYearLink = Helper::getSortingLink($search, 'search', 'birthyear', $sort);
$OrderGroupNumberLink = Helper::getSortingLink($search, 'search', 'groupnumber', $sort);
$OrderPointsLink = Helper::getSortingLink($search, 'search', 'points', $sort);

// Ссылки c обратной сортировкой asc/desc
$reverseSort = ($sort == 'asc' ? 'desc' : 'asc');
$SortNameLink = Helper::getSortingLink($search,'search', 'name', $reverseSort);
$SortLastNameLink = Helper::getSortingLink($search,'search', 'lastname', $reverseSort);
$SortBirthYearLink = Helper::getSortingLink($search,'search', 'birthyear', $reverseSort);
$SortGroupNumberLink = Helper::getSortingLink($search,'search', 'groupnumber', $reverseSort);
$SortPointsLink = Helper::getSortingLink($search,'search', 'points', $reverseSort);

// Создаём ссылку со всеми имеющимися параметрами $_GET и используем в pager'е в аргументе linkpattern чтобы не терять параметры
$link = Helper::getSortingLink($search, 'search', $order, $sort);
$pager = new \StudentList\Pager( $abiturientGateway->getAbiturientCountByQuery($search) , 10, "{$link}&page={page}");
$pages = $pager->build();

require_once ROOT . '/views/templates/header.php';
require_once ROOT . '/views/abiturientList.php';
require_once ROOT . '/views/templates/footer.php';
