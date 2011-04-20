<?php

/**
 * Ce test regroupe les éléments optgroup contenant un élément label pour
 * qu'un testeur puisse vérifier la pertinance du label au vu du contenu
 * de l'élément optgroup
 *
 * @author Adrien Couet
 *
 */
class PertinenceDeLAttributLabel extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $optgroups = $page->crawler->filter('optgroup');
    foreach ($optgroups as $optgroup)
    {
      $hasLabel = false;
      foreach ($optgroup->childNodes as $child)
      {
        $hasLabel = $hasLabel || (strtolower($child->nodeName) === 'label');
      }
      if ($hasLabel)
      {
        $reussite = false;
        $this->complements[] = new Complement(
          $this->getSourceCode($optgroup),
          $this->getXPath($optgroup),
          'Vérifier que l\'élément label donne les information nécessaire pour'.
          ' identifier le contenu de l\'élément optgroup'
        );
      }
    }
    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}