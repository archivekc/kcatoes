<?php

/**
 * Compte dans la page le nombre d'élément frame et iframe sans attribut title
 * ou avec un attribut title vide.
 * Si ce compte est différent de 0, le test échoue.
 *
 * @author Adrien Couet
 *
 */
class AbsenceDeCadresNonTitres extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient ';
  }

  public function execute(Page $page)
  {
    $count = 0;
    $crawler = $page->crawler;
    $titles = $crawler->filter('iframe, frame')->extract('title');
    foreach ($titles as $title)
    {
      if ($title == '')
      {
        $count++;
      }
    }

    $this->explication .= $count.' éléments (i)frame sans titre ou avec un titre vide';
    return ($count == 0);
  }
}