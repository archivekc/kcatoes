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
    $reussite = true;
    $titles = $page->crawler->filter('title');

    if (count($titles) === 0)
    {
      $this->complements[] = new Complement('', '', 'Aucun titre n\'est présent dans la page');
      $reussite = false;
    }
    return $reussite ? Resultat::REUSSITE : Resultat::ECHEC;
  }
}