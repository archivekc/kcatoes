<?php

class TestEchec extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $this->complements[] = new Complement('Test de code', 'Test de XPath', 'Echoue toujours');
    return Resultat::ECHEC;
  }
}