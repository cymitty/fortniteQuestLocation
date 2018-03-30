<?php

namespace StudentList;


class AbiturientDataGateway
{
  private $DBH;
  public function __construct(\PDO $DBH)
  {
    $this->DBH = $DBH;
  }
  public function getAbiturientById($id)
  {

  }
  /*
   * @return Abiturient[]
   */
  public function getAllAbiturients()
  {
    $sth = $this->DBH->query( ' SELECT * from abiturient ' );
//    $sth->setFetchMode( \PDO::FETCH_CLASS, 'Abiturient' );
    $result = $sth->fetchAll( \PDO::FETCH_CLASS, __NAMESPACE__ . '\\Abiturient' );// Двойной слэшь перед названием класса потому что php экранирует символы...
    return $result;
  }
  /*
   * @return true|false
   */
  public function addAbiturient(Abiturient $abiturient)
  {
    $sth = $this->DBH->prepare( "INSERT INTO abiturient (name, lastname, groupnumber, email, points, birthyear)
        values (:name, :lastname, :groupnumber, :email, :points, :birthyear)" );
    $sth->bindValue( ':name', $abiturient->getName() );
    $sth->bindValue( ':lastname', $abiturient->getLastName() );
    $sth->bindValue( ':groupnumber', $abiturient->getGroupNumber() );
    $sth->bindValue( ':email', $abiturient->getEmail() );
    $sth->bindValue( ':points', $abiturient->getPoints() );
    $sth->bindValue( ':birthyear', $abiturient->getBirthYear() );
    $data = $sth->execute();
    return $data;
  }

}