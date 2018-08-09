<?php
use MyFortniteBundle\{Controller,Registry,Helper};
use MyFortniteBundle\Entity\{Quest,Pointer};

class testController extends Controller
{
    public function index()
    {
        $questGateway   = new MyFortniteBundle\QuestDataGateway(Registry::instance()->getData('DBH'));
        $pointerGateway = new \MyFortniteBundle\PointerDataGateway(Registry::instance()->getData('DBH'));
        // add new Quest
        //$quest = new \MyFortniteBundle\Quest(
        //    'new',
        //    'something',
        //    2,
        //    5,
        //    '2plus2');
        //if ($questGateway->addQuest($quest)) echo "Был добавлен новый квест\n";//ad
        $quests = $questGateway->getQuestsBySeason(5);
        $questsTree = Helper::buildQuestsTree($quests);

        $this->view('test.php', [
            'questsTree' => $questsTree,
        ]);
    }

}