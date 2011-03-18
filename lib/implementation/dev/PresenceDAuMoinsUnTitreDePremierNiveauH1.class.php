<?php

/**
 * Vérifie la présence d'au moins un titre de premier niveau hiérarchique (h1)
 * dans la page
 *
 * @author Adrien Coeut
 *
 */
class PresenceDAuMoinsUnTitreDePremierNiveauH1 extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page ne contient pas de titre de hiérarchie de premier niveau (h1)';
  }

  public function execute(Page $page)
  {
    $crawler = $page->crawler;
    $h1 = $crawler->filter('h1');

    return (count($h1) > 0);
  }
}