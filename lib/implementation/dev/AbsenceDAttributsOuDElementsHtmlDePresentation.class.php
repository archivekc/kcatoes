<?php

/**
 * Recherche dans la page la présence des éléments ou attribut suivants:
 * basefont, blink, center, font, marquee, s, strike, tt, u, align, alink,
 * background, basefont, bgcolor, border, color, link, text, vlink
 *
 * Si aucune correspondance n'est trouvée, le test est réussit. Sinon, il échoue
 * et un Echec est créé pour chaque correspondance trouvée.
 *
 * @package Kcatoes
 * @author Adrien Couet
 *
 */
class AbsenceDAttributsOuDElementsHtmlDePresentation extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $resultat = true;
    $crawler = $page->crawler;

    $elements = 'basefont, blink, center, font, marquee, s, strike, tt, u';
    $attributs  = '[align], [alink], [background], [basefont], [bgcolor], [border],
                [color], [link], [text], [vlink]';

    $nodes = $crawler->filter($elements);
    foreach ($nodes as $node)
    {
      $this->echecs[] = new Echec(
        $this->getSourceCode($node),
        $this->getXPath($node),
        'Cet élément est un élément HTML de présentation'
      );
    }
    $resultat = $resultat && (count($nodes) === 0);

    $nodes = $crawler->filter($attributs);
    foreach ($nodes as $node)
    {
      $this->echecs[] = new Echec(
        $this->getSourceCode($node),
        $this->getXPath($node),
        'Cet élément utilise un attribut de présentation'
      );
    }
    $resultat = $resultat && (count($nodes) === 0);

    return $resultat;
  }
}