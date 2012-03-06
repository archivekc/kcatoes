<?php

/**
 * Compte le nombre d'élément bgsound de la page.
 * Si ce compte est différent de 0, le test échoue.
 *
 * @author Adrien Couet
 *
 */
class AbsenceDElementBgsound extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient ';
  }

  public function execute(Page $page)
  {
    $crawler = $page->crawler;
    $bgsounds = $crawler->filter('bgsound');

    $this->explication .= count($bgsounds).' élément(s) bgsound';

    return count($bgsounds) == 0;
  }
}