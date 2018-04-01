<?php
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/classes/AbiturientDataGateway.php';
require_once __DIR__ . '/../app/classes/Abiturient.php';
require_once __DIR__ . '/../app/classes/AbiturientValidator.php';

$abiturientGateway = new \StudentList\AbiturientDataGateway($DBH);
$abiturientValidator = new \StudentList\AbiturientValidator($abiturientGateway);
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $name = array_key_exists('name', $_POST) ? strval($_POST['name']) : '';
  $lastName = array_key_exists('lastname', $_POST) ? strval($_POST['lastname']) : '';
  $email = array_key_exists('email', $_POST) ? strval($_POST['email']) : '';
  $groupNumber = array_key_exists('groupnumber', $_POST) ? strval($_POST['groupnumber']) : '';
  $points = array_key_exists('points', $_POST) ? strval($_POST['points']) : '';
  $birthYear = array_key_exists('birthyear', $_POST) ? strval($_POST['birthyear']) : '';

  $newAbiturient = new \StudentList\Abiturient($name, $lastName, $email, $groupNumber, $points, $birthYear);
  $errors = $abiturientValidator->checkFields($newAbiturient);

  if ( empty($errors) )
  {
    $abiturientGateway->addAbiturient($newAbiturient);
    header("Location: /index.php?notify=registered");
    die();
  }

}

require_once ROOT . '/views/register.php';