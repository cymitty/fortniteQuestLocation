<?php
/**
 * Created by PhpStorm.
 * User: amitty
 * Date: 8/9/2018
 * Time: 9:43 PM
 */


use MyFortniteBundle\Controller;
use MyFortniteBundle\Entity\{Quest,Pointer};
use MyFortniteBundle\Helper;
use MyFortniteBundle\Registry;

class indexController extends Controller
{

    public function index()
    {
        $questGateway   = new MyFortniteBundle\QuestDataGateway( Registry::instance()->getData('DBH') );
        $pointerGateway = new \MyFortniteBundle\PointerDataGateway( Registry::instance()->getData('DBH') );

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

        $this->view('index.php', [
            'questsTree' => $questsTree,
        ]);
    }

    public function addPointerOffering()
    {
        //$questGateway   = new MyFortniteBundle\QuestDataGateway( Registry::instance()->getData('DBH') );
        $pointerGateway = new \MyFortniteBundle\PointerDataGateway( Registry::instance()->getData('DBH') );

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
    }

}