<?php

class BienImplemente extends ASource
{
  public function __construct()
  {
    $this->explication = 'Herite bien de ASource';
  }

  public function execute(Page $page)
  {
    return true;
  }
}