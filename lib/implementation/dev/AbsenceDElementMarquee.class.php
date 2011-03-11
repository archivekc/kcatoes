<?php

/**
 * Compte le nombre d'élément marquee de la page.
 * Si ce compte est différent de 0, le test échoue.
 *
 * @author Adrien Couet
 *
 */
class AbsenceDElementMarquee extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient ';
  }

  public function execute(Page $page)
  {
    $crawler = $page->crawler;
    $marquees = $crawler->filter('marquee');

    $this->explication .= count($marquees).' élément(s) marquee';

    return count($marquees) == 0;
  }
}