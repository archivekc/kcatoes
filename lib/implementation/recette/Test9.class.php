<?php	
class Test9 extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    throw new KcatoesTestException('Erreur d\'exécution volontaire');
  }
}