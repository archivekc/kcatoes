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
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $titles = $page->crawler->filter('h2, h3, h4, h5, h6')->each(function ($node, $i)
    {
      return $node;
    });

    for ($i = count($titles)-1 ; $i > 0 ; $i--)
    {
      $current  = $titles[$i];
      $previous = $titles[$i-1];

      $currentRange  = intval(preg_replace('#h#', '', $current->nodeName));
      $previousRange = intval(preg_replace('#h#', '', $previous->nodeName));

      if (($currentRange - $previousRange) != 0
           && ($currentRange - $previousRange) != 1
           && (($previousRange - $currentRange) < 0 || ($previousRange - $currentRange) > 4))
      {
        $reussite = false;
        $this->echecs[] = new Echec($this->getSourceCode($current),
                                    $this->getXPath($current),
                                    'Ce titre interrompt ne respecte pas les règles '.
                                    'de hiérarchie: il n\'est ni au même niveau, '.
                                    'ni un niveau en dessous, ni dans un intervale '.
                                    'de 4 niveaux au dessus de celui qui le précède');
      }
    }

    return $reussite;
  }
}