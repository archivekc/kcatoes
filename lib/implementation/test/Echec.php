<?php

namespace KCatoes\lib\implementation;

class Echec extends ASource
{
  public function __construct()
  {
    $this->explication = 'Echoue toujours';
  }

  public function execute(Page $page)
  {
    return false;
  }
}