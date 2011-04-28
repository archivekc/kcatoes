<?php

/**
 * Vérifie que tous les éléments fieldset contiennent un élément legend
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class AbsenceDElementFieldsetSansElementLegend extends ASource
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

      if (!$hasLegend)
      {
        $this->complements[] = new Complement(
          $this->getSourceCode($fieldset),
          $this->getXPath($fieldset),
          'Cet élément ne contient pas d\'élément legend'
        );
        $reussite = false;
      }
    }

    return $reussite ? Resultat::REUSSITE : Resultat::ECHEC;
  }
}