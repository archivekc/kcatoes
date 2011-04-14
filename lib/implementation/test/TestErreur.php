<?php

class TestErreur extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    throw new KcatoesTestException('Ce test declenche toujours une exception');
  }
}