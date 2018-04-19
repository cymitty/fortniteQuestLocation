<?php
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/classes/abiturientDataGateway.php';
require_once __DIR__ . '/../app/classes/abiturient.php';
require_once __DIR__ . '/../app/classes/abiturientValidator.php';
require_once __DIR__ . '/../app/classes/Helper.php';
require_once ROOT . '/classes/Helper.php';
$notifiesText = [
    'registered' => 'Вы успешно зарегистрировались в списке абитуриентов.',
    'updated' => 'Информация была обновлена.'
];

$abiturientGateway = new \StudentList\abiturientDataGateway($DBH);
$abiturientValidator = new \StudentList\abiturientValidator($abiturientGateway);
$errors = [];

//Если пришел notify key в GET
$notify = array_key_exists('notify', $_GET) ? $_GET['notify']: '';
$notifies = [];
if ( !empty($notify) )
{
  $notifies[] = array_key_exists($notify, $notifiesText) ? $notifiesText[$notify] : '';
}

$abiturient = new \StudentList\abiturient();
$abiturientToken = array_key_exists('AuthorizedToken', $_COOKIE) ? strval($_COOKIE['AuthorizedToken']) : null;

if ( isset($abiturientToken) ) {
  $abiturient = $abiturientGateway->getAbiturientByPassword($abiturientToken);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $name = array_key_exists('name', $_POST) ? strval($_POST['name']) : '';
  $lastName = array_key_exists('lastname', $_POST) ? strval($_POST['lastname']) : '';
  $email = array_key_exists('email', $_POST) ? strval($_POST['email']) : '';
  $groupNumber = array_key_exists('groupnumber', $_POST) ? strval($_POST['groupnumber']) : '';
  $points = array_key_exists('points', $_POST) ? strval($_POST['points']) : '';
  $birthYear = array_key_exists('birthyear', $_POST) ? strval($_POST['birthyear']) : '';
  $abiturient->setName($name);
  $abiturient->setLastName($lastName);
  $abiturient->setEmail($email);
  $abiturient->setGroupNumber($groupNumber);
  $abiturient->setPoints($points);
  $abiturient->setBirthYear($birthYear);

  $errors = $abiturientValidator->checkFields($abiturient);
  if ( empty($errors) )
  {

    if ( isset($abiturientToken) ) {
      // Если изменяем данные зарегестрированного
      //$abiturient = $abiturientGateway->getabiturientByPassword($abiturientToken);
      $abiturientGateway->updateAbiturient($abiturient, $abiturientToken);
      header("Location: /register.php?notify=updated");
      die();
    }
    else {
      // Добавляем нового
      $abiturient->setPassword(\StudentList\Helper::generateCookiePassword());
      $abiturientGateway->addabiturient($abiturient);
      setcookie("AuthorizedToken", $abiturient->getPassword(), strtotime('+2 years'));
      header("Location: /index.php?notify=registered");
      die();
    }
  }
}

if ($abiturient == false)
{
  $abiturient = new \StudentList\Abiturient();
}
require_once ROOT . '/views/templates/header.php';
require_once ROOT . '/views/register.php';
require_once ROOT . '/views/templates/footer.php';