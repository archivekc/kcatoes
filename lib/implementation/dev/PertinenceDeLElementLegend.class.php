<?php

/**
 * Ce test regroupe les éléments fieldset contenant un élément legend pour qu'un
 * testeur puisse vérifier la pertinance de la légende au vu du contenu de
 * l'élément fieldset
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class PertinenceDeLElementLegend extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $fieldsets = $page->crawler->filter('fieldset');
    foreach ($fieldsets as $fieldset)
    {
      $hasLegend = false;
      foreach ($fieldset->childNodes as $child)
      {
        $hasLegend = $hasLegend || (strtolower($child->nodeName) === 'legend');
      }
      if ($hasLegend)
      {
        $reussite = false;
        $this->complements[] = new Complement(
          $this->getSourceCode($fieldset),
          $this->getXPath($fieldset),
          'Vérifier que l\'élément legend donne les information nécessaire '.
          'pour identifier le contenu de l\'élément fieldset'
        );
      }
    }
    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}