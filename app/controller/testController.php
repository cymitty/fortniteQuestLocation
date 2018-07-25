<?php
use MyFortniteBundle\{Quest,Helper};
$questGateway   = new MyFortniteBundle\QuestDataGateway($DBH);
$pointerGateway = new \MyFortniteBundle\PointerDataGateway($DBH);
//add new Quest
//$quest = new \MyFortniteBundle\Quest(
//    'new',
//    'something',
//    2,
//    5,
//    '2plus2');
//if ($questGateway->addQuest($quest)) echo "Был добавлен новый квест\n";//ad

$quests = $questGateway->getQuestsBySeason(5);
var_dump($quests);

$questsTree = Helper::buildQuestsTree($quests);

//var_dump($questsTree);

echo '<h1>Сработал testController. Ты на странице test.</h1>';
require_once ROOT . '/app/view/test.php';
