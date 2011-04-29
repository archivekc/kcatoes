<?php	
class Test3 extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    return Resultat::ECHEC;
  }
}