<?php

/**
 * Ce test regroupe les éléments select ne contenant aucun élément optgroup.
 * Un testeur devra vérifier si les éléments option présents dans le select ne
 * nécessitent pas de faire au moins deux regroupements distincs.
 *
 * @author Adrien Couet
 *
 */
class UtilisationDeLElementOptgroupDansUnElementSelect extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $selects = $page->crawler->filter('select');
    foreach ($selects as $select)
    {
      $hasOptgroup = false;
      foreach ($select->childNodes as $child)
      {
        $hasOptgroup = $hasOptgroup || (strtolower($child->nodeName) === 'optgroup');
      }
      if (!$hasOptgroup)
      {
        $reussite = false;
        $this->echecs[] = new Echec($this->getSourceCode($select),
                                    $this->getXPath($select),
                                    'Vérifier si les éléments option présent'.
                                    ' dans l\'élément select ne nécessite pas'.
                                    ' de faire au moins deux regroupements distincs');
      }
    }
    return $reussite;
  }
}