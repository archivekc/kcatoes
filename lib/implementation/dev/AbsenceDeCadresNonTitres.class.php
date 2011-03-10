<?php

class AbsenceDeCadresNonTitres extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient ';
  }

  public function execute(Page $page)
  {
    $count = 0;
    $resultat = true;
    $crawler = $page->crawler;
    $titles = $crawler->filter('frame, iframe')->extract('title');

    foreach ($titles as $title)
    {
      $resultat = $resultat && ($title != '');
      $count++;
    }

    $this->explication .= $count.' éléments (i)frame sans titre ou avec un titre vide';
    return $resultat;
  }
}