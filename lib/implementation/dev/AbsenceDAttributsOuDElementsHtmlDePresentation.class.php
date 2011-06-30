<?php

/**
 * Recherche dans la page la présence des éléments ou attribut suivants:
 * basefont, blink, center, font, marquee, s, strike, tt, u, align, alink,
 * background, basefont, bgcolor, border, color, link, text, vlink
 *
 * Si aucune correspondance n'est trouvée, le test est réussit. Sinon, il échoue
 * et un Complement est créé pour chaque correspondance trouvée.
 *
 * @package Kcatoes
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class AbsenceDAttributsOuDElementsHtmlDePresentation extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $crawler = $page->crawler;

    $elements = 'basefont, blink, center, font, marquee, s, strike, tt, u';
    $attributs  = '[align], [alink], [background], [basefont], [bgcolor],'.
                  '[border], [color], [link], [text], [vlink]';

    $nodes = $crawler->filter($elements);
    foreach ($nodes as $node)
    {
      $this->complements[] = new Complement(
        $this->getSourceCode($node),
        $this->getXPath($node),
        'Cet élément est un élément HTML de présentation'
      );
    }
    $reussite = $reussite && (count($nodes) === 0);

    $nodes = $crawler->filter($attributs);
    foreach ($nodes as $node)
    {
      $this->complements[] = new Complement(
        $this->getSourceCode($node),
        $this->getXPath($node),
        'Cet élément utilise un attribut de présentation'
      );
    }
    $reussite = $reussite && (count($nodes) === 0);

    return $reussite ? Resultat::REUSSITE : Resultat::ECHEC;
  }
}