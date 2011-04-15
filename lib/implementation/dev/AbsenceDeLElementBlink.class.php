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
  }

  public function execute(Page $page)
  {
    $crawler = $page->crawler;
    $blinks = $crawler->filter('blink');

    foreach ($blinks as $blink)
    {
      $this->echecs[] = new Echec($this->getSourceCode($blink),
                                  $this->getXPath($blink),
                                  'Cet élément ne devrait pas être présent dans la page');
    }

    return count($blinks) == 0;
  }
}