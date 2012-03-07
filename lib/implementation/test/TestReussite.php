<?php

class TestReussite extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    return Resultat::REUSSITE;
  }
}