<?php

/**
 * Pour chaque élément dl, si le premier élément fils n'est pas un élément dt
 * alors le test échoue. Dans ce cas, il compte le nombre d'éléments dd présents
 * dans le dl avant l'appartition du premier dt.
 *
 * @author Adrien Couet
 *
 */
class BalisageCorrectDesListesDeDefinitions extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient ';
  }

  public function execute(Page $page)
  {
    $count = 0;
    $crawler = $page->crawler;
    $liste = $crawler->filter('dl');

    foreach($liste as $item)
    {
      if($item->firstChild->nodeName != 'dt')
      {
        $childNodes = $item->childNodes;
        $i = 0;
        while($childNodes->item($i)->nodeName != 'dt')
        {
          if ($childNodes->item($i)->nodeName == 'dd')
          {
            $count++;
          }
          $i++;
        }
      }
    }

    $this->explication .= $count.' éléments dd qui ne sont pas associés à un élément dt';
    return ($count == 0);
  }
}