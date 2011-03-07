<?php

namespace KCatoes\lib\implementation;

class Palpatine extends ASource
{
  public function __construct()
  {
    $this->explication = 'Fallait pas perdre deux étoiles de la mort';
  }

  public function execute(Page $page)
  {
    return false;
  }
}