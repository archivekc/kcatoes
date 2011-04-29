<?php

class TestUnitaire1 extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    return Resultat::REUSSITE;
  }
}