<?php

/**
 * Compte le nombre d'éléments optGroup dont l'attribut label et absent ou vide.
 * Si ce compte est différent de 0, le test échoue.
 *
 * @author Adrien Couet
 *
 */
class PresenceDUnAttributLabelSurLElementOptgroup extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient ';
  }

  public function execute(Page $page)
  {
    $crawler = $page->crawler;
    $count = 0;
    $optGroupAlts = $crawler->filter('optgroup')->extract('label');

    foreach ($optGroupAlts as $optGroupAlt)
    {
      if ($optGroupAlt == '')
      {
        $count++;
      }
    }

    $this->explication .= $count.' éléments optGroup dont l\'attribut label est absent ou vide';
    return ($count == 0);
  }
}