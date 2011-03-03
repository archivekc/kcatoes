<?php

class DarkMaul
{
  public function __construct()
  {
    $this->explication = 'Un problème d\'héritage ?';
  }

  public function execute(Page $page)
  {
    return false;
  }
}