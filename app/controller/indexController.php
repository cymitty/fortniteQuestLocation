<?php
/**
 * Created by PhpStorm.
 * User: amitty
 * Date: 7/16/2018
 * Time: 7:21 PM
 */
use MyFortniteBundle\{Quest,Helper};
$questGateway   = new MyFortniteBundle\QuestDataGateway($DBH);
$pointerGateway = new \MyFortniteBundle\PointerDataGateway($DBH);

if (Helper::isXMLHttpRequest())
{
    $request = json_decode(file_get_contents('php://input'));
    $pointerId = (int) $request->id ?? false;
    $pointer = $pointerGateway->getPointerById($pointerId);
    if (!$pointer)
    {
        echo false;
        exit;
    }

    echo json_encode([
        "x" => $pointer->getX(),
        "y" => $pointer->getY()
    ]);
    exit;
}

$quests = $questGateway->getQuestsBySeason(5);
//var_dump($quests);

$questsTree = Helper::buildQuestsTree($quests);

include_once VIEW . '/index.php';
