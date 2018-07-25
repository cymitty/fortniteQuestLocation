<?php

namespace StudentList;


class Abiturient
{
  const GENDER_MALE = 'M';
  const GENDER_FEMALE = 'F';

  private $id;
  private $name;
  private $lastName;
  private $gender;
  private $groupNumber;
  private $email;
  private $points;
  private $birthYear;
  private $password;

  public function __construct($name = '', $lastName = '', $email = '', $groupNumber = '', $points = '', $birthYear = '', $password = '')
  {
    $this->name = $name;
    $this->lastName = $lastName;
    $this->email = $email;
    $this->groupNumber = $groupNumber;
    $this->points = $points;
    $this->birthYear = $birthYear;
    $this->password = $password;
  }

  public function getId()
  {
    return $this->id;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getLastName()
  {
    return $this->lastName;
  }
  public function setLastName($lastName)
  {
    $this->lastName = $lastName;
  }
  public function getGender()
  {
    return $this->gender;
  }
  public function setGender($gender)
  {
    $this->gender = $gender;
  }
  public function getGroupNumber()
  {
    return $this->groupNumber;
  }
  public function setGroupNumber($groupNumber)
  {
    $this->groupNumber = $groupNumber;
  }
  public function getEmail()
  {
    return $this->email;
  }
  public function setEmail($email)
  {
    $this->email = $email;
  }
  public function getPoints()
  {
    return $this->points;
  }
  public function setPoints($points)
  {
    $this->points = $points;
  }
  public function getBirthYear()
  {
    return (int) $this->birthYear;
  }
  public function setBirthYear($birthYear)
  {
    $this->birthYear = $birthYear;
  }
  public function getPassword()
  {
    return $this->password;
  }
  public function setPassword($password)
  {
    $this->password = $password;
  }

}