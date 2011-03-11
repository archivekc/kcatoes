<?php

/**
 * Compte le nombre d'éléments de formulaire de la page n'ayant ni un attribut
 * title ni label associé.
 * Si ce compte est différent de 0, le test échoue.
 *
 * @author Adrien Couet
 *
 */
class AbsenceDElementDeFormulaireSansEtiquetteAssociee extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient ';
  }
  //TODO Gérer les cas [title=""]
  public function execute(Page $page)
  {
    $count = 0;
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
      }
    }
    $this->explication .= $count.' élément(s) de formulaire sans attribut title ou sans label associé';
    return ($count == 0);
  }
}