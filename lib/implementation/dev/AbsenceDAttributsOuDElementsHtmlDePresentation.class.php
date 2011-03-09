<?php

class AbsenceDAttributsOuDElementsHtmlDePresentation extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient au moins un élément basefont, blink, center, '.
                          'font, marquee, s, strike, tt ou u et/ou utilise au moins un '.
                          'attribut [align], [alink], [background], [basefont], [bgcolor], '.
                          '[border], [color], [link], [text] ou [vlink]';
  }

  public function execute(Page $page)
  {
    $crawler = $page->crawler;
    $nodes = $crawler->filter('basefont, blink, center, font, marquee, s, strike, tt, u, '.
                              '[align], [alink], [background], [basefont], [bgcolor], [border], '.
                              '[color], [link], [text], [vlink]');
    return count($nodes) == 0;
  }
}