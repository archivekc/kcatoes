<?php

/**
 * Compte le nombre d'éléments permettant d'afficher une image et qui ne disposent
 * pas d'un attibut alt présents dans la page. Si ce compte est différent de 0,
 * le test échoue.
 *
 * @author Adrien Couet
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
    $crawler = $page->crawler;
    $count = 0;
    $imagesAlt = $crawler->filter('img, area, input[type=image], applet')->extract('alt');

    foreach($imagesAlt as $imageAlt)
    {
      if ($imageAlt == '')
      {
        $count++;
      }
    }

    $this->explication .= $count.' image(s) sans attribut alt';
    return ($count == 0);
  }
}