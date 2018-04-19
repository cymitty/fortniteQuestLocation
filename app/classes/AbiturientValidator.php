<?php

namespace StudentList;


class AbiturientValidator
{
  public $gateway;

  public function __construct(AbiturientDataGateway $gateway)
  {
    $this->gateway = $gateway;
  }

  public function checkFields(Abiturient $abiturient) {
    $errors = [];

    $abiturient->setName(         trim( $abiturient->getName() )        );
    $abiturient->setLastName(     trim( $abiturient->getLastName() )    );
    $abiturient->setEmail(        trim( $abiturient->getEmail() )       );
    $abiturient->setGroupNumber(  trim( $abiturient->getGroupNumber() ) );
    $abiturient->setBirthYear(    trim( $abiturient->getBirthYear() )   );
    if ( strlen( $abiturient->getName()  ) > 40 )
      $errors['name'] = 'В поле имя слишком много символов, возможно вы ошиблись.';
    if ( strlen( $abiturient->getName()  ) == 0 )
      $errors['name'] = 'Мы должны знать как к вам обращаться, укажите своё имя.';
    if ( strlen( $abiturient->getLastName()  ) > 40 )
      $errors['lastName'] = 'В поле фамилия слишком много символов, возможно вы ошиблись.';
    if ( strlen( $abiturient->getLastName()  ) == 0 )
      $errors['lastName'] = 'Мы должны знать как к вам обращаться, укажите свою фамилию.';
    if ( strlen( $abiturient->getEmail() ) == 0 )
      $errors['email'] = 'Вы не указали почту, укажите чтобы мы могли с вами связаться.';
    if ( $this->existingEmail( $abiturient ) )
      $errors['existingEmail'] = 'Пользователь с такой почтой уже зарегестрирован.';
    if ( strlen( $abiturient->getGroupNumber() ) == 0 )
      $errors['groupNumber'] = 'Вы оставили пустым обязательное поле номер группы.';
    if ( strlen( $abiturient->getGroupNumber() ) < 3 || $abiturient->getGroupNumber() > 350 )
      $errors['incorrectGroupNumber'] = 'Группа №' . $abiturient->getGroupNumber() . ' не существует.';
    if ( $abiturient->getPoints() == 0)
      $errors['points'] = 'Вы оставили пустым обязательное поле Баллы.';
    if ( $abiturient->getPoints() > 300)
      $errors['incorrectPoints'] = 'Суммарное число баллов не может превышать 300.';
    if ( strlen( $abiturient->getBirthYear() == 0 ) )
      $errors['birthYear'] = 'Вы оставили пустым обязательное поле Год рождения.';
    $abiturientAge = date('Y') - $abiturient->getBirthYear();
    if ( $abiturientAge < 16 )
      $errors['incorrectBirthYear'] = 'Абитуриенту должно быть не менее 16ти лет.';

    return $errors;
  }

  public function existingEmail(Abiturient $abiturient)
  {
    $abiturientWithSameEmail = $this->gateway->getAbiturientByEmail( $abiturient->getEmail() );

    if ( $abiturientWithSameEmail )//Если изменяем данные о пользователе
    {
      if ( $abiturientWithSameEmail->getId() == $abiturient->getId() )
      {
        return false;
      }
    }
    //Если пользователь новый
    return $abiturientWithSameEmail ? true : false;
  }
}