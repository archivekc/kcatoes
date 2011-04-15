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
  }

  public function execute(Page $page)
  {
    $crawler = $page->crawler;
    $bgsounds = $crawler->filter('bgsound');

    foreach ($bgsounds as $bgsound)
    {
      $this->echecs[] = new Echec($this->getSourceCode($bgsound),
                                  $this->getXPath($bgsound),
                                  'Cet élément ne devrait pas être présent dans la page');
    }

    return count($bgsounds) == 0;
  }
}