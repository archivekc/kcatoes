<?php

/**
 * Cet test regroupe les éléments de la page pouvant afficher des zones de couleur
 * pour qu'un tester puisse vérifier que si ces zones de couleur apportent de
 * l'information, alors cette information est accessible autremenet que par la
 * couleur.
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class AlternativeALaCouleur4 extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $elements = $page->crawler->filter('img, input[type=image], applet, object, embed');
    foreach ($elements as $element)
    {
      $reussite = false;
      $this->complements[] = new Complement(
        $this->getSourceCode($element),
        $this->getXPath($element),
        'Si cet élément affiche des zones de couleurs donnant de l\'information,'.
        ' vérifier que cette information est accessible par un moyen autre que '.
        'la couleur.'
      );
    }
    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}