<?php
use MyFortniteBundle\{Quest,Pointer,Helper};


$questGateway = new MyFortniteBundle\QuestDataGateway($DBH);
$pointerGateway = new MyFortniteBundle\PointerDataGateway($DBH);

if (Helper::isXMLHttpRequest())
{
    $response = [];
    $request = json_decode(file_get_contents("php://input"));
    $questId = (int) $request->id ?? false;
    $pointer = $pointerGateway->addOfferingPointerById($request->x, $request->y, $questId);

    if (!$pointer) {

        echo json_encode([
            'status' => 0
        ]);
        exit;
    }
    echo json_encode([
        'status' => 1
    ]);
    exit;
}

$quests = $questGateway->getQuestsBySeason(5);
$questsTree = Helper::buildQuestsTree($quests);

include_once VIEW . "/admin/add-pointer.php";