<?php

class TestMalImplemente
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $this->echecs[] = new Echec('Test de code', 'Test de XPath', 'Echoue toujours');
    return false;
  }
}