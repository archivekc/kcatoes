<?php

class Test3 extends ASource
{
  public function __construct()
  {
    $this->explication = 'Ce test ne peut pas réussir';
  }

  public function execute(Page $page)
  {
    return false;
  }
}