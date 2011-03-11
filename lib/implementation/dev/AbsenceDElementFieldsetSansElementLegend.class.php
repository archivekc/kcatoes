<?php

/**
 * Compte dans la page le nombre d'élément fieldset sans attribut legend
 * ou avec un attribut legend vide.
 * Si ce compte est différent de 0, le test échoue.
 *
 * @author Adrien Couet
 *
 */
class AbsenceDElementFieldsetSansElementLegend extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient: ';
  }

  public function execute(Page $page)
  {
    $count = 0;
    $crawler = $page->crawler;
    $legends = $crawler->filter('fieldset')->extract('legend');
    foreach ($legends as $legend)
    {
      if ($legend == '')
      {
        $count++;
      }
    }

    $this->explication .= $count.' éléments fieldset sans légende ou avec une légende vide';
    return ($count == 0);
  }
}