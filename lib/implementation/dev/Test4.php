<?php

class Test4 extends ASource
{
  public function __construct()
  {
    $this->explication = 'Ce test provoquera une erreur';
  }

  public function execute(Page $page)
  {
    throw new KcatoesTestException('Erreur volontaire');
  }
}