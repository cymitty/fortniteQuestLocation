<?php

namespace StudentList;


class Abiturient
{
  const GENDER_MALE = 'M';
  const GENDER_FEMALE = 'F';

  private $name;
  private $lastName;
  private $gender;
  private $groupNumber;
  private $email;
  private $points;
  private $birthYear;

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
    $this->$lastName = $lastName;
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
    return $this->birthYear;
  }
  public function setBirthYear($birthYear)
  {
    $this->birthYear = $birthYear;
  }


}