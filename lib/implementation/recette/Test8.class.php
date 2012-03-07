<?php	
class Test8 extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    return Resultat::MANUEL;
  }
}