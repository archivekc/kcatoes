<?php

class DarkVador extends ASource
{
  public function __construct()
  {
    $this->explication = 'Une vrai girouette...';
  }

  public function execute(Page $page)
  {
    throw new KcatoesTestException('Quand on change trop souvent de camp, ça fait bugger la matrice');
  }
}