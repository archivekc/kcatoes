<?php

/**
 * Vérifie que les éléments optgroup ont tous attribut label et que celui-ci
 * n'est pas vide
 *
 * @author Adrien Couet
 *
 */
class PresenceDUnAttributLabelSurLElementOptgroup extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $crawler = $page->crawler;
    $count = 0;
    $optGroups = $crawler->filter('optgroup');

    foreach ($optGroups as $optGroup)
    {
      if (!$optGroup->hasAttribute('label'))
      {
        $reussite = false;
        $this->echecs[] = new Echec($this->getSourceCode($optGroup),
                                    $this->getXPath($optGroup),
                                    'Cet élément optgroup ne possède pas d\'attribut label');
      }
      else
      {
        $label = $optGroup->getAttribute('label');
        if (empty($label))
        {
          $reussite = false;
          $this->echecs[] = new Echec($this->getSourceCode($optGroup),
                                      $this->getXPath($optGroup),
                                      'Cet élément optgroup a un attribut label vide');
        }
      }
    }

    return $reussite;
  }
}