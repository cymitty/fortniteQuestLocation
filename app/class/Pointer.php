<?php
/**
 * Created by PhpStorm.
 * User: amitty
 * Date: 7/17/2018
 * Time: 12:13 PM
 */

namespace MyFortniteBundle;


class Pointer
{
    private $id;
    private $x;// В процентах т.к карта на которой он будет,
    private $y;// может иметь разный размер в зависимости от экрана устройства.
    private $quest_id;

    public function __construct($x = "", $y = "")
    {
        $this->x    = $x;
        $this->y    = $y;
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


}