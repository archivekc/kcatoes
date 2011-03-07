<?php

class MaitreYoda extends ASource
{
  public function __construct()
  {
    $this->explication = 'Maitre Yoda ne failli jamais.';
  }

  public function execute(Page $page)
  {
    return true;
  }
}