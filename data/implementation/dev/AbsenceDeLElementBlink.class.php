<?php

/**
 * Compte le nombre d'éléments blink dans la page.
 * Si ce compte est différent de 0, le test échoue.
 *
 * @author Adrien Couet
 *
 */
class AbsenceDeLElementBlink extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient ';
  }

  public function execute(Page $page)
  {
    $crawler = $page->crawler;
    $blinks = $crawler->filter('blink');

    $this->explication .= count($blinks).' élément(s) blink';

    return count($blinks) == 0;
  }
}