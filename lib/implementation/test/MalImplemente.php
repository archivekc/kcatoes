<?php

class MalImplemente
{
  public function __construct()
  {
    $this->explication = 'N\'herite pas de ASource';
  }

  public function execute(Page $page)
  {
    return false;
  }
}