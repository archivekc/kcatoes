<?php

/**
 * Vérifie que les titres de la page respectent la hiérarchie suivante:
 * Un titre doit être soit du même niveau que celui qui le précède,
 * soit un niveau en dessous, soit jusqu'à 4 niveaux au dessus.
 *
 * @author Adrien Couet
 *
 */
class AbsenceDInterruptionDansLaHierarchieDesTitres extends ASource
{
  public function __construct()
  {
    $this->explication = 'Un titre doit se situer par rapport à celui qui le précède au même niveau, un niveau au dessus ou jusqu\'à 4 niveaux en dessous';
  }

  public function execute(Page $page)
  {
    $resultat = true;
    $crawler = $page->crawler;
    $titles = $crawler->filter('h2, h3, h4, h5, h6');
    $titleNames = $titles->each(function ($node, $i)
    {
      return $node->nodeName;
    });
    for ($i = count($titleNames)-1; $i > 0; $i--)
    {
      $titleRange = intval(preg_replace('#h#', '', $titleNames[$i]));
      $previousRange = intval(preg_replace('#h#', '', $titleNames[$i-1]));
      if (($titleRange - $previousRange) != 0
           && ($titleRange - $previousRange) != 1
           && (($previousRange - $titleRange) < 0 || ($previousRange - $titleRange) > 4))
      {
        $resultat = false;
      }
    }
    return $resultat;
  }
}