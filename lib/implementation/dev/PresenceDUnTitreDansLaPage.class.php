<?php

/**
 * Vérifie la présence d'au moins un élément title dans la page
 *
 * @author Adrien Couet
 *
 */
class PresenceDUnTitreDansLaPage extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $titles = $page->crawler->filter('title');

    if (count($titles) === 0)
    {
      $this->echecs[] = new Echec('', '', 'Aucun titre n\'est présent dans la page');
      return false;
    }
    return true;
  }
}