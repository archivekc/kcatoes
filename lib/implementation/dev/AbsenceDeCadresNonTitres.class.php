<?php

/**
 * Vérifie que tous les éléments frame et iframe de la page ont bien un titre
 * et que celui-ci n'est pas une chaine vide.
 *
 * echecs contiendra la liste des éléments frame et iframe de la page ne
 * respectant pas ces deux conditions.
 *
 * @author Adrien Couet
 *
 */
class AbsenceDeCadresNonTitres extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $crawler = $page->crawler;
    $nodes = $crawler->filter('iframe, frame');
    foreach ($nodes as $node)
    {
      if (!$node->hasAttribute('title'))
      {
        $this->echecs[] = new Echec($this->getSourceCode($node),
                                    $this->getXPath($node),
                                    'Cet élément n\'a pas d\'attribut title');
        $reussite = false;
      }
      elseif ($node->getAttribute('title') === '')
      {
        $this->echecs[] = new Echec($this->getSourceCode($node),
                                    $this->getXPath($node),
                                    'Cet élément a un attribut title vide');
        $reussite = false;
      }
    }

    return $reussite;
  }
}