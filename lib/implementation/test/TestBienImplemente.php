<?php

class TestBienImplemente extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    return true;
  }
}