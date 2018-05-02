<?php

require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/classes/AbiturientDataGateway.php';
require_once __DIR__ . '/../app/classes/Abiturient.php';
require_once __DIR__ . '/../app/classes/Helper.php';
$abiturient = new \StudentList\Abiturient();
$abiturientGateway = new \StudentList\AbiturientDataGateway($DBH);
$faker = Faker\Factory::create();
//Добавляем 10 записей в таблицу абитуриент
for ($i = 0; $i < 10; $i++)
{
  $abiturient->setName($faker->unique()->firstName);
  $abiturient->setLastName($faker->unique()->lastName);
  $abiturient->setEmail($faker->unique()->email);
  $abiturient->setPoints($faker->numberBetween(0, 300));
  $abiturient->setGroupNumber($faker->numberBetween(100, 300));
  $abiturient->setBirthYear($faker->year);
  $abiturient->setPassword(\StudentList\Helper::generateCookiePassword());

  $abiturientGateway->addAbiturient($abiturient);
}

echo 'Успешно добавлены 10 случайных абитуриентов';
//echo $faker->name . '<br>';
//echo $faker->lastName . '<br>';
//echo $faker->email . '<br>';
//echo $faker->unique()->numberBetween(0, 300) . '<br>';
//echo $faker->unique()->numberBetween(100, 300) . '<br>';

