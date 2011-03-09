<?php

/**
 * Classe dont devra hériter le code de chaque test automatisable
 *
 * @package Kcatoes
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
abstract class ASource
{
  protected $explication;

  /**
   * Renvoi l'explication du résultat de l'exécution du test
   *
   * @return String $explication L'explication du résultat
   */
  public function getExplication()
  {
    return $this->explication;
  }

  /**
   * Exécute le test implémenté sur une page web
   *
   * @param Page $page La page sur à tester
   */
  abstract public function execute(Page $page);
}