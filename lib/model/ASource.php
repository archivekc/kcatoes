<?php

/**
 * Classe dont devra hériter le code de chaque test automatisable
 *
 * @author Adrien Couet
 *
 */
abstract class ASource
{
  protected $explication;

  public function getExplication()
  {
    return $this->explication;
  }

  abstract public function execute(Page $page);
}
