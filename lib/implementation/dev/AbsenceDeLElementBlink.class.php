<?php

class AbsenceDeLElementBlink extends ASource
{
  public function __construct()
  {
    $this->explication = 'La page contient ';
  }

  public function execute(Page $page)
  {
    $crawler = $page->crawler;
    $blinks = $crawler->filter('blink');

    $this->explication .= count($blinks).' élément(s) blink';

    return count($blinks) == 0;
  }
}