<?php

class AbsenceDAttributsOuDElementsHtmlDePresentation extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient le(s) élément(s) suivants:';
  }

  public function execute(Page $page)
  {
    $resultat = true;
    $crawler = $page->crawler;
    $elements = array('basefont', 'blink', 'center', 'font', 'marquee', 's', 'strike', 'tt', 'u',
                     '[align]', '[alink]', '[background]', '[basefont]', '[bgcolor]', '[border]',
                     '[color]', '[link]', '[text]', '[vlink]');
    foreach($elements as $element)
    {
      $nodes = $crawler->filter($element);
      if (count($nodes) != 0)
      {
        if ($resultat)
        {
          $this->explication .= ' '.$element;
          $resultat = false;
        }
        else
        {
          $this->explication .= ', '.(String)$element;
        }
      }
    }
    return $resultat;
  }
}