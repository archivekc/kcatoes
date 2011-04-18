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
  }

  public function execute(Page $page)
  {
    $crawler = $page->crawler;
    $marquees = $crawler->filter('marquee');

    foreach ($marquees as $marquee)
    {
      $this->echecs[] = new Echec($this->getSourceCode($marquee),
                                  $this->getXPath($marquee),
                                  'La balise marquee ne devrait pas être présente dans la page');
    }

    return count($marquees) == 0;
  }
}