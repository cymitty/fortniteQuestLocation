<?php
use MyFortniteBundle\{Quest,Pointer,Helper};

$questGateway = new MyFortniteBundle\QuestDataGateway($DBH);
$pointerGateway = new \MyFortniteBundle\PointerDataGateway($DBH);

var_dump($requestUrl);

if (Helper::isXMLHttpRequest())
{
    $data = json_decode(file_get_contents('php://input'));
    if ($data->action == 'agree')
    {
        if ((is_float($data->x) || is_int($data->x)) && (is_float($data->y) || is_int($data->y)) && is_int($data->quest_id)) {
            $pointer = new Pointer($data->pointer_id, $data->x, $data->y, $data->quest_id);
            $pointerGateway->updatePointer($pointer);
            $pointerGateway->removeOfferingPointerById($pointer->getId()); // Удаление из списка предложений
            echo json_encode([
                "status" => 1,
                "text" => "Информация была обновлена успешно",
            ]);
            exit;
        } else {
            echo json_encode([
                "status" => 0,
                "text" => "Были отправлены данные в неверном формате",
            ]);
            exit;
        }
    }
    if ($data->action == 'degree') {
        $pointerId = $data->pointer_id;
        $pointerGateway->removeOfferingPointerById($pointerId); // Удаление из списка предложений
        echo json_encode([
            "status" => 1,
            "text" => "Предложение было отклонено",
        ]);
        exit;
    }
}

$locationOffers = $pointerGateway->getAllLocationOffers();


require_once VIEW . "/admin/index.php";