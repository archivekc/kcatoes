<?php

/**
 * Ce test regroupe tous les éléments permettant d'afficher une image pour qu'un
 * tester puisse vérifier que si l'image ou son attribut alt mentionne une couleur
 * pour faire référence à un contenu dans la page ou le site, alors un moyen
 * autre que la couleur permet d'identifier ce contenu.
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class AlternativeALaCouleur2 extends ASource
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
      if ($element->hasAttribute('alt') && !empty($element->getAttribute('alt')))
      {
        $this->complements[] = new Complement(
          $this->getSourceCode($element),
          $this->getXPath($element),
          'Si l\'attribut alt de cet élément mentionne une couleur et fait '.
          'référence à un contenu de la page ou du site, vérifier qu\'il '.
          'permet d\'identifier ce contenu par un autre moyen que la couleur.'
        );
      }
      else
      {
        $this->complements[] = new Complement(
          $this->getSourceCode($element),
          $this->getXPath($element),
          'Si cet élément permet d\'afficher un texte et si ce texte mentionne'.
          ' une couleur et fait référence à un coutenu de la page ou du site, '.
          'qu\'il permet d\'identifier ce contenu par un autre moyen que la '.
          'couleur.'
        );
      }
    }
    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}