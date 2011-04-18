<?php

/**
 * Pour chaque élément dl, si le premier élément fils n'est pas un élément dt
 * alors le test échoue. Si c'est le cas, le tableau d'echecs contiendra la
 * liste des éléments dd n'ayant pas d'élément dt associé.
 *
 * @author Adrien Couet
 *
 */
class BalisageCorrectDesListesDeDefinitions extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
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
            $reussite = false;
            $this->echecs[] = new Echec($this->getSourceCode($childNodes->item($i)),
                                        $this->getXPath($childNodes->item($i)),
                                        'Cet élément dd n\' pas associé à un élément dt');
          }
          $i++;
        }
      }
    }

    return $reussite;
  }
}