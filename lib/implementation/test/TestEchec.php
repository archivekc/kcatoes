<?php

class TestEchec extends ASource
{
  public function __construct()
  {
    $this->echecs = array();
  }

  public function execute(Page $page)
  {
    $this->echecs[] = new Echec('Test de code', 'Test de XPath', 'Echoue toujours');
    return false;
  }
}