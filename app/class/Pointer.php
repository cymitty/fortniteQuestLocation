<?php
/**
 * Created by PhpStorm.
 * User: amitty
 * Date: 7/17/2018
 * Time: 12:13 PM
 */

namespace MyFortniteBundle\Entity;


class Pointer
{
    private $id;
    private $x;// В процентах т.к карта на которой он будет,
    private $y;// может иметь разный размер в зависимости от экрана устройства.
    private $quest_id;
    private $quest_name;

    public function __construct($id = "", $x = "", $y = "", $quest_id = "")
    {
        $this->id = $id;
        $this->x    = $x;
        $this->y    = $y;
        $this->quest_id = $quest_id;
    }

    public function __toString()
    {
        return "x: {$this->x} y: {$this->y}";
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param mixed $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param mixed $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }

    /**
     * @return mixed
     */
    public function getQuestId()
    {
        return $this->quest_id;
    }

    /**
     * @param mixed $quest_id
     */
    public function setQuestId($quest_id): void
    {
        $this->quest_id = $quest_id;
    }

    /**
     * @return mixed
     */
    public function getQuestName()
    {
        return $this->quest_name;
    }

    /**
     * @param mixed $quest_name
     */
    public function setQuestName($quest_name): void
    {
        $this->quest_name = $quest_name;
    }

}