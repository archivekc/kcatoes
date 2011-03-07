<?php

class LukeSkywalker extends ASource
{
  public function __construct()
  {
    $this->explication = 'Pas besoin d\'expliquer';
  }

  public function execute(Page $page)
  {
    $result = true;
    $crawler = $page->crawler;
    $alts = $crawler->filter('img')->extract('alt');
    foreach ($alts as $alt)
    {
      //echo 'Luke Skywalker - texte alternatif à une image trouvé: '.$alt.'<br />';
      $result = $result && ($alt != '');
    }
    return $result;
  }
}