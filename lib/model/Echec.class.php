<?php

class Echec
{
  private $code;
  private $xPath;
  private $explication;

  public function __construct($_code, $_xPath, $_explication)
  {
    $this->code        = $_code;
    $this->xPath      = $_xPath;
    $this->explication = $_explication;
  }

  public function __get($var)
  {
    return $this->$var;
  }
}