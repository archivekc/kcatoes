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
    $this->explication = 'Aucun titre n\'est présent dans la page';
  }

  public function execute(Page $page)
  {
    $crawler = $page->crawler;
    $titles = $crawler->filter('title');

    return (count($titles) > 0);
  }
}