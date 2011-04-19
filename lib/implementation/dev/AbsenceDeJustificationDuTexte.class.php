<?php

/**
 * Vérifie qu'aucun élément de la page n'utilise la propriété d'alignement justify
 *
 * @author Adrien Coeut
 *
 */
class AbsenceDeJustificationDuTexte extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $nodes = $page->crawler->filter('*');
    foreach ($nodes as $node)
    {
      if ($node->hasAttribute('align') && $node->getAttribute('align') === 'justify')
      {
        $this->echecs[] = new Echec($this->getSourceCode($node),
                                    $this->getXPath($node),
                                    'Cet élément utilise la propriété d\'alignement de texte justify');
        $reussite = false;
      }
      if ($node->hasAttribute('style') && preg_match('#justify#', $node->getAttribute('style')))
      {
        $this->echecs[] = new Echec($this->getSourceCode($node),
                                    $this->getXPath($node),
                                    'Cet élément utilise la propriété d\'alignement de texte justify');
        $reussite = false;
      }
    }

    return $reussite;
  }
}