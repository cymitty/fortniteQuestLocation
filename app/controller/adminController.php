<?php
/**
 * Created by PhpStorm.
 * User: amitty
 * Date: 8/10/2018
 * Time: 12:18 AM
 */
use MyFortniteBundle\{Controller,Helper,Registry};
use MyFortniteBundle\Entity\{Quest,Pointer};

class adminController extends Controller
{
    public function index()
    {
        $pointerGateway = new \MyFortniteBundle\PointerDataGateway(Registry::instance()->getData('DBH'));

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

        $this->view('admin/index.php', [
            'locationOffers' => $locationOffers,
        ]);
    }

    public function addPointer()
    {
        $questGateway = new MyFortniteBundle\QuestDataGateway(Registry::instance()->getData('DBH'));

        $quests = $questGateway->getQuestsBySeason(5);
        $questsTree = Helper::buildQuestsTree($quests);

        $this->view("admin/add-pointer.php", [
            'questsTree' => $questsTree,
        ]);
    }
}