<?php
/**
 * Created by PhpStorm.
 * User: amitty
 * Date: 7/17/2018
 * Time: 12:17 PM
 */

namespace MyFortniteBundle;


class PointerDataGateway
{
    const FETCH_MODE = 8|1048576;
    const CLASS_NAME = "MyFortniteBundle\Pointer";
    private $DBH;

    public function __construct(\PDO $DBH)
    {
        $this->DBH = $DBH;
    }

    public function addPointer($x, $y, Quest $quest)
    {
        $sth = $this->DBH->prepare("INSERT INTO Pointer (
          x, y, quest_id) 
          VALUES (:x, :y, :quest_id)
        ");
        $sth->bindValue(':x', $x);
        $sth->bindValue(':y', $y);
        $sth->bindValue(':quest_id', $quest->getId());
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

    public function removePointer(Quest $quest)
    {
        $sth = $this->DBH->prepare("DELETE FROM Pointer WHERE id = :id");
        $sth->bindValue('id', $quest->getId());
        return $sth->execute();
    }

    public function removePointerById($questId)
    {
        $sth = $this->DBH->prepare("DELETE FROM Pointer WHERE id = :id");
        $sth->bindValue('id', $questId);
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

}