<?php

/**
 * Ce test regroupe les éléments label de la page possédant soit un attribut title,
 * soit un contenu texte pour qu'un testeur puisse vérifier que le titre/contenu
 * texte donne la fonction exacte de l'élément auquel le label se rapporte.
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class PertinenceDesEtiquettes extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $labels = $page->crawler->filter('label');
    foreach ($labels as $label)
    {
      if ($label->hasAttribute('title'))
      {
        $reussite = false;
        $this->complements[] = new Complement(
          $this->getSourceCode($label),
          $this->getXPath($label),
          'Vérifier que l\'attribut title de ce label donne la fonction exacte'.
          ' de l\'élément auquel il se rapporte'
        );
      }
      else
      {
        $hasTextContent = false;
        foreach ($label->childNodes as $child)
        {
          $hasTextContent = $hasTextContent || (strtolower($child->nodeName) === '#text');
        }
        if ($hasTextContent)
        {
          $this->complements[] = new Complement(
            $this->getSourceCode($label),
            $this->getXPath($label),
            'Vérifier que le contenu texte de ce label donne la fonction exacte'.
            ' de l\'élément auquel il se rapporte'
          );
        }
      }
    }
    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}