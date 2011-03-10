<?php

class AbsenceDElementDeFormulaireSansEtiquetteAssociee extends ASource
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
    $elements = $crawler->filter('input[type=text][id]:not([title]), input[type=password][id]:not([title]),
                                 input[type=file][id]:not([title]), input[type=radio][id]:not([title]),
                                 input[type=checkbox][id]:not([title]), textarea[id]:not([title]),
                                 select[id]:not([title])');
    $ids = $elements->each(function ($node, $i)
                  {
                    return $node->attributes->getNamedItem('id')->nodeValue;
                  });
    foreach($ids as $id)
    {
      $labels = $crawler->filter('label[for='.$id.']');
      if (count($labels) != 1)
      {
        $count++;
        $resultat = false;
      }
    }
    $this->explication .= $count.' élément(s) de formulaire sans attribut title ou sans label associé';
    return $resultat;
  }
}