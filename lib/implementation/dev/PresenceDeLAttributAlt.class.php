<?php

/**
 * Vérifie que toutes les images de la page ont bien un attribut alt.
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class PresenceDeLAttributAlt extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient ';
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $images = $page->crawler->filter('img, area, input[type=image], applet');

    foreach($images as $image)
    {
      if (!$image->hasAttribute('alt'))
      {
        $reussite = false;
        $this->complements[] = new Complement(
          $this->getSourceCode($image),
          $this->getXPath($image),
          'Cette image ne possède pas d\'attribut alt'
        );
      }
    }

    return $reussite ? Resultat::REUSSITE : Resultat::ECHEC;
  }
}