<?php

namespace StudentList;


class AbiturientValidator
{
  public $gateway;

  public function __construct(AbiturientDataGateway $gateway)
  {
    $this->gateway = $gateway;
  }

  public function existingEmail(Abiturient $abiturient)
  {
    $result = $this->gateway->getAbiturientByEmail( $abiturient->getEmail() );
    return $result ? true : false;
  }
}