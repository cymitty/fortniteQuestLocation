<?php

namespace StudentList;


class AbiturientDataGateway
{
  private $DBH;

  public function __construct(\PDO $DBH)
  {
    $this->DBH = $DBH;
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
    $result = $sth->execute();
    return $result;
  }

  public function getAbiturientById($id)
  {
    $sth = $this->DBH->prepare('SELECT * from abiturient where id = :id ');
    $sth->bindValue(':id', $id);
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute();
    return $sth->fetch();
  }

  public function getAbiturientByEmail($email)
  {
    $sth = $this->DBH->prepare('SELECT * from abiturient where email = :email');
    $sth->bindValue(':email', $email);
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute();
    return $sth->fetch();
  }

}