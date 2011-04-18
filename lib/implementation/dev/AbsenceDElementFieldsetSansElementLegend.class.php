<?php

/**
 * Vérifie que tous les éléments fieldset contiennent un élément legend
 *
 * @author Adrien Couet
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
    $crawler = $page->crawler;

    $fieldsets = $crawler->filter('fieldset');
    foreach ($fieldsets as $fieldset)
    {
      $legendFound = false;
      foreach ($fieldset->childNodes as $child)
      {
        if (strtolower($child->nodeName) === 'legend')
        {
          $legendFound = true;
        }
      }

      if (!$legendFound)
      {
        $this->echecs[] = new Echec($this->getSourceCode($fieldset),
                                    $this->getXPath($fieldset),
                                    'Cet élément ne contient pas d\'élément legend');
        $reussite = false;
      }
    }

    return $reussite;
  }
}