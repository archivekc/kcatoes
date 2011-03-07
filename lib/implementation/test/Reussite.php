<?php

namespace KCatoes\lib\implementation;

class Reussite extends ASource
{
  public function __construct()
  {
    $this->explication = 'Réussit toujours';
  }

  public function execute(Page $page)
  {
    return true;
  }
}