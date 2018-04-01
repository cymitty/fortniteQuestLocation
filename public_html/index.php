<?php

require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/classes/AbiturientDataGateway.php';
require_once __DIR__ . '/../app/classes/Abiturient.php';
require_once __DIR__ . '/../app/classes/AbiturientValidator.php';

$notifiesValues = [
    'registered' => '<p>Вы успешно зарегистрировались в списке абитуриентов.</p>'
];
$notifyText = '';
$notifies = array_key_exists('notify', $_GET) ? $_GET['notify'] : '';

if ( !empty($notifies) )
{
  $notifyText = array_key_exists('registered', $notifiesValues) ? $notifiesValues['registered'] : '';
}

$gateway = new \StudentList\AbiturientDataGateway($DBH);
$validator = new \StudentList\AbiturientValidator($gateway);

echo "<div class='notify'>" . $notifyText . "</div>";

foreach ( $gateway->getAllAbiturients() as $Abiturient) {
  echo $Abiturient->getName() . '<br>';
  echo $Abiturient->getLastName() . '<br>';
  echo $Abiturient->getEmail() . '<br>';
  echo "<br>";
}


