<?php

/**
 * Ce test regroupe les éléments frame et iframe possédant un attribut title
 * non vide pour permettre à un testeur de vérifier l'adéquation entre le titre
 * du cadre et son contenu.
 *
 * @author Adrien Couet
 *
 */
class PertinenceDesTitresDonnesAuxCadres extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $nodes = $page->crawler->filter('iframe, frame');
    foreach ($nodes as $node)
    {
      if ($node->hasAttribute('title'))
      {
        if ($node->getAttribute('title') !== '')
        {
          $this->complements[] = new Complement(
            $this->getSourceCode($node),
            $this->getXPath($node),
            'Vérifier que l\'attribut title de ce cadre correspond à son contenu'
          );
          $reussite = false;
        }
      }
    }

    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}