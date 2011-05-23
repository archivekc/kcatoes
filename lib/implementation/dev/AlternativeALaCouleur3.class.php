<?php

/**
 * Regroupe les éléments de la page utilisant une propriété CSS permettant de
 * réaliser une mise en couleur pour qu'un tester puisse vérifier que si cet
 * élément apporte de l'information par la couleur, alors cette information est
 * accessible autrement que par la couleur.
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class AlternativeALaCouleur3 extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $cssProperties = $page->crawler->filter(
      '[color], [background-color], [background],
       [border-color], [border], [outline-color], [outline]'
    );
    foreach ($cssProperties as $cssProperty)
    {
      $reussite = false;
      $this->complements[] = new Complement(
        $this->getSourceCode($cssProperty),
        $this->getXPath($cssProperty),
        'Si cet élément apporte de l\'information par la couleur, vérifier si '.
        'cette information est accessible par un moyen autre que la couleur'
      );
    }
    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}