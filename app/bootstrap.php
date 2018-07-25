<?php
define('ROOT', dirname( __FILE__ ) . "/..");
define('VIEW', dirname(__FILE__) . "/view");

$config = parse_ini_file('config.ini');

$dsn = $config['db'] . ':host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=' . $config['charset'];

try {
  $DBH = new PDO( $dsn, $config['user'], $config['password'] );
  // Может быть будут нужны постоянные соединения http://php.net/manual/ru/pdo.connections.php
  $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Режим выброса исключений
} catch (PDOException $e) {
  echo "Error!: " . $e->getMessage() . "<br/>";
  die();
}
// MyFortniteBundle loader
spl_autoload_register(function ($class) {
    $data = explode("\\", $class);
    if ($data[0] != 'MyFortniteBundle') return;

    $path = __DIR__ . "/class/" . $data[1] . ".php";
    if (file_exists($path)) {
        require_once $path;
    }
});

require_once ROOT . '/vendor/autoload.php';

//function my_autoload ($className) {
//  // Получаем путь к файлу из имени класса
//  $path = __DIR__ . '/models/' . $className . '.php';
//  // Если в текущей папке есть такой файл, то выполняем код из него
//  if (file_exists($path)) {
//    require_once $path;
//  }
//  // Если файла нет, то ничего не делаем - может быть, класс
//  // загрузит какой-то другой автозагрузчик или может быть,
//  // такого класса нет
//}
//spl_autoload_register("my_autoload");
