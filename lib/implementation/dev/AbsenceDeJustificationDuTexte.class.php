<?php

class AbsenceDeJustificationDuTexte extends ASource
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
    $elements = $crawler->filter('*')->extract(array('align', 'style'));
    foreach ($elements as $element)
    {
      if ($element[0] == 'justify' || preg_match('#justify#', $element[1]))
      {
        $resultat = false;
        $count++;
      }
    }

    $this->explication .= $count.' bloc(s) de texte justifié(s)';
    return $resultat;
  }
}