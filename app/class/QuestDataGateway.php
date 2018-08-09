<?php
/**
 * Created by PhpStorm.
 * User: amitty
 * Date: 7/16/2018
 * Time: 5:24 PM
 */

namespace MyFortniteBundle;

use MyFortniteBundle\Entity\Quest as Quest;

class QuestDataGateway
{
    const FETCH_MODE = 8|1048576;
    const CLASS_NAME = "MyFortniteBundle\Entity\Quest";
    private $DBH;

    public function __construct(\PDO $DBH) {
        $this->DBH = $DBH;
    }

    /**
     * @param Quest $quest
     * @return bool
     */
    public function addQuest(Quest $quest): bool
    {
        $sth = $this->DBH->prepare("INSERT INTO Quest (
            name, description, week, season, slug)
            VALUES (:name, :description, :week, :season, :slug)"
        );
        $sth->bindValue(':name', $quest->getName());
        $sth->bindValue(':description', $quest->getDescription());
        $sth->bindValue(':week', $quest->getWeek());
        $sth->bindValue(':season', $quest->getSeason());
        $sth->bindValue(':slug', $quest->getSlug());
        return $sth->execute();
    }

    public function removeQuest(Quest $quest)
    {
        $sth = $this->DBH->prepare("delete from Quest where id = :id");
        $sth->bindValue('id', $quest->getId());
        return $sth->execute();
    }

    public function getQuestByName($name)
    {
        $sth = $this->DBH->prepare("select * from Quest where name = :name");
        $sth->bindValue('name', $name);
        $sth->setFetchMode($this::FETCH_MODE, $this::CLASS_NAME);
        $sth->execute();
        return $sth->fetch();
    }

    public function getQuestById($id)
    {
        $sth = $this->DBH->prepare("select * from Quest where id = :id");
        $sth->bindValue(':id', $id, \PDO::PARAM_INT);
        $sth->setFetchMode($this::FETCH_MODE, $this::CLASS_NAME);
        $sth->execute();
        return $sth->fetch();
    }

    public function getAllQuests()
    {
        $sth = $this->DBH->prepare("SELECT * from Quest");
        $sth->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, __NAMESPACE__ . '\\Quest' );
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function getQuestsBySeason($season)
    {
        $sth = $this->DBH->prepare("SELECT * from Quest where season = :season");
        $sth->bindValue(":season", $season);
        $sth->setFetchMode($this::FETCH_MODE, $this::CLASS_NAME);
        $sth->execute();
        return $sth->fetchAll();
    }

}