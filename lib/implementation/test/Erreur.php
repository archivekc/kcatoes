<?php

namespace KCatoes\lib\implementation;

class Erreur extends ASource
{
  public function __construct()
  {
    $this->explication = 'Declenche toujours une erreur';
  }

  public function execute(Page $page)
  {
    throw new KcatoesTestException('Ce test declenche toujours une exception');
  }
}