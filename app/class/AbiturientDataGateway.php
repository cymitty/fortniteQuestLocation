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
   * offset - с какого элемента начать.
   * page - какую страницу запрашивают
   * Стандартно выдаём сортировку по баллам ЕГЭ и по убыванию
   *   * @return Abiturient[]
   */
  public function getAbiturients($limit, $offset, $order = 'points', $sort = 'desc')
  {
    // Через bindValue не работает т.к доабвляет ковычки '', а нужны ``
    $orders = array("name","lastname","groupnumber","points","birthyear");
    $key = array_search($order,$orders);
    $order = $orders[$key];
    // Через bindValue не работает т.к доабвляет ковычки '', а нужны ``
    $sorts = array("asc","desc");
    $key = array_search($sort,$sorts);
    $sort = $sorts[$key];

    $sth = $this->DBH->prepare( "SELECT * from abiturient ORDER BY $order $sort LIMIT :limit OFFSET :offset" );
    $sth->bindValue(':limit', $limit, \PDO::PARAM_INT);
    $sth->bindValue(':offset', $offset, \PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetchAll( \PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, __NAMESPACE__ . '\\Abiturient' );// Двойной слэшь перед названием класса потому что php экранирует символы...
    return $result;
  }

  public function getAbiturientsByQuery($search = '', $limit = 5, $offset = 0, $order = 'points', $sort = 'desc')
  {
    // Через bindValue не работает т.к доабвляет ковычки '', а нужны ``
    $orders = array("name","lastname","groupnumber","points","birthyear");
    $key = array_search($order,$orders);
    $order = $orders[$key];
    // Через bindValue не работает т.к доабвляет ковычки '', а нужны ``
    $sorts = array("asc","desc");
    $key = array_search($sort,$sorts);
    $sort = $sorts[$key];

    $sth = $this->DBH->prepare( " select * from abiturient WHERE CONCAT_WS('|', `name`, `lastName`, `points`, `birthYear`, `groupnumber`) 
                                            LIKE :search ORDER BY $order $sort LIMIT :limit OFFSET :offset" );
    $sth->bindValue(':search', "%{$search}%");
//    $sth->bindValue(':order', $order );
//    $sth->bindValue(':sort', $sort);
    $sth->bindValue(':limit', $limit, \PDO::PARAM_INT);
    $sth->bindValue(':offset', $offset, \PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetchAll( \PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, __NAMESPACE__ . '\\Abiturient' );// Двойной слэшь перед названием класса потому что php экранирует символы...
    return $result;
  }

  /*
   * @return true|false
   */
  public function addAbiturient(Abiturient $abiturient)
  {
    $sth = $this->DBH->prepare( "INSERT INTO abiturient (name, lastname, groupnumber, email, points, birthyear, password)
        values (:name, :lastname, :groupnumber, :email, :points, :birthyear, :password)" );
    $sth->bindValue( ':name', $abiturient->getName() );
    $sth->bindValue( ':lastname', $abiturient->getLastName() );
    $sth->bindValue( ':groupnumber', $abiturient->getGroupNumber() );
    $sth->bindValue( ':email', $abiturient->getEmail() );
    $sth->bindValue( ':points', $abiturient->getPoints() );
    $sth->bindValue( ':birthyear', $abiturient->getBirthYear() );
    $sth->bindValue( ':password', $abiturient->getPassword() );
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
    $sth->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, __NAMESPACE__ . '\\Abiturient' );
    $sth->execute();
    return $sth->fetch();
  }

  public function getAbiturientByPassword($password) {
    $sth = $this->DBH->prepare('SELECT * from abiturient where password = :password');
    $sth->bindValue(':password', $password);
    $sth->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, __NAMESPACE__ . '\\Abiturient' );
    $sth->execute();
    return $sth->fetch();
  }

  public function getAbiturientCount() {
    $sth = $this->DBH->query('SELECT COUNT(*) from abiturient');
    $sth->execute();
    $result = $sth->fetch();
    return (int)$result[0];
  }
  public function getAbiturientCountByQuery($search = '') {
    $sth = $this->DBH->prepare( " select COUNT(*) from abiturient WHERE CONCAT_WS('|', `name`, `lastName`, `points`, `birthYear`, `groupnumber`) 
                                            LIKE :search" );
    $sth->bindValue(':search', "%{$search}%");
    $sth->execute();
    $result = $sth->fetch();
    return $result[0];
  }

  public function updateAbiturient(Abiturient $abiturient, $abiturientToken)
  {
    $sth = $this->DBH->prepare('UPDATE abiturient SET name = :name,
                                            lastname = :lastname,
                                            groupnumber = :groupnumber,
                                            email = :email,
                                            points = :points,
                                            birthyear = :birthyear
                                            WHERE id = :id and password = :password');
    $sth->bindValue( ':name', $abiturient->getName() );
    $sth->bindValue( ':lastname', $abiturient->getLastName() );
    $sth->bindValue( ':groupnumber', $abiturient->getGroupNumber() );
    $sth->bindValue( ':email', $abiturient->getEmail() );
    $sth->bindValue( ':points', $abiturient->getPoints() );
    $sth->bindValue( ':birthyear', $abiturient->getBirthYear() );
    $sth->bindValue( ':password', $abiturientToken);
    $sth->bindValue( ':id', $abiturient->getId() );
    return $sth->execute();
  }
  public function checkEmail( $id, $email )
  {
    $sth = $this->DBH->prepare('SELECT COUNT(*) from abiturient where id = :id and email = :email');
    $sth->bindValue(':id', $id);
    $sth->bindValue(':email', $email);
    $result = $sth->execute();
    return $result;
  }

}