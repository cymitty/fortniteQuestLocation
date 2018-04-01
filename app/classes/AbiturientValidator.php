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
    if ( strlen( $abiturient->getEmail() ) == 0 ) $errors['email'] = 'Необходимо указать ваш адрес email, иначе мы не сможем связаться с вами.';
    if ( strlen( $abiturient->getName()  ) > 12 ) $errors['name'] = 'В поле имя слишком много символов, возможно вы ошиблись.';
    return $errors;
  }

  public function existingEmail(Abiturient $abiturient)
  {
    $result = $this->gateway->getAbiturientByEmail( $abiturient->getEmail() );
    return $result ? true : false;
  }
}