<?php
/**
 * Created by PhpStorm.
 * User: amitty
 * Date: 7/17/2018
 * Time: 12:17 PM
 */

namespace MyFortniteBundle;

use MyFortniteBundle\Entity\Pointer as Pointer;

class PointerDataGateway
{
    const FETCH_MODE = 8|1048576;
    const CLASS_NAME = "MyFortniteBundle\Entity\Pointer";
    private $DBH;

    public function __construct(\PDO $DBH)
    {
        $this->DBH = $DBH;
    }

    public function addPointer(Pointer $pointer)
    {
        $sth = $this->DBH->prepare("INSERT INTO Pointer (
          x, y, quest_id) 
          VALUES (:x, :y, :quest_id)
        ");
        $sth->bindValue(':x', $pointer->getX());
        $sth->bindValue(':y', $pointer->getY());
        $sth->bindValue(':quest_id', $pointer->getQuestId());
        return $sth->execute();
    }

    public function addPointerById($x, $y, $questId)
    {
        $sth = $this->DBH->prepare("INSERT INTO Pointer (
          x, y, quest_id) 
          VALUES (:x, :y, :quest_id)
        ");
        $sth->bindValue(':x', $x);
        $sth->bindValue(':y', $y);
        $sth->bindValue(':quest_id', $questId);
        return $sth->execute();
    }

    public function addOfferingPointerById($x, $y, $questId)
    {
        $sth = $this->DBH->prepare("INSERT INTO location_offers (
          x, y, quest_id) 
          VALUES (:x, :y, :quest_id)
        ");
        $sth->bindValue(':x', $x);
        $sth->bindValue(':y', $y);
        $sth->bindValue(':quest_id', $questId);
        return $sth->execute();
    }


//    Обновляет Pointer если нету - создаёт новый
    public function updatePointer(Pointer $pointer)
    {
        $existingPointer = $this->getPointerById($pointer->getQuestId());
        if ($existingPointer)
        {
            $sth = $this->DBH->prepare('UPDATE pointer SET x = :x, y = :y, quest_id = :quest_id WHERE quest_id = :quest_id');
            $sth->bindValue('id', $pointer->getId());
            $sth->bindValue('x', $pointer->getX());
            $sth->bindValue('y', $pointer->getY());
            $sth->bindValue('quest_id', $pointer->getQuestId());
            return $sth->execute();
        }
        return $this->addPointer($pointer);
    }

    public function removePointer(Quest $quest)
    {
        $sth = $this->DBH->prepare("DELETE FROM Pointer WHERE id = :id");
        $sth->bindValue('id', $quest->getId());
        return $sth->execute();
    }

    public function removePointerById($id)
    {
        $sth = $this->DBH->prepare("DELETE FROM Pointer WHERE id = :id");
        $sth->bindValue('id', $id);
        return $sth->execute();
    }

    public function removeOfferingPointerById($id)
    {
        $sth = $this->DBH->prepare("DELETE FROM location_offers WHERE id = :id");
        $sth->bindValue('id', $id);
        return $sth->execute();
    }

    public function getAllPointersBySeason($season){}

    public function getAllPointers(){}

    public function getPointerById($id)
    {
        $sth = $this->DBH->prepare("SELECT * FROM Pointer where quest_id = :id");
        $sth->bindValue(':id', $id, \PDO::PARAM_INT);
        $sth->setFetchMode($this::FETCH_MODE, $this::CLASS_NAME);
        $sth->execute();
        return $sth->fetch();
    }

    public function getPointerByQuest(Quest $quest)
    {
        $sth = $this->DBH->prepare("SELECT * FROM Pointer where quest_id = :id");
        $sth->bindValue(':id', $quest->getId());
        $sth->setFetchMode($this::FETCH_MODE, $this::CLASS_NAME);
        $sth->execute();
        return $sth->fetch();
    }

    // Вывод всех предложенных меток
    public function getAllLocationOffers()
    {
        $sth = $this->DBH->prepare('SELECT o.*, quest.name as quest_name from location_offers o JOIN quest ON o.quest_id = quest.id');
        $sth->setFetchMode($this::FETCH_MODE, $this::CLASS_NAME);
        $sth->execute();
        return $sth->fetchAll();
    }

}