<?php
namespace Kcatoes\rgaa;

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


class AbsenceDAttributsOuDElementsHtmlDePresentation extends \ASource
{
	
  const testName = 'Absence d\'attribut ou d\'élément HTML de présentation';
  const testId = '1.1.1';
  const testProc = 'Vérifier les éléments titi, tutu, toto, tata';
	
  public function __construct()
  {
  }

  public function execute(\Page $page)
  {
    $crawler = $page->crawler;

    $elements = 'basefont, blink, center, font, marquee, s, strike, tt, u';
    $attributs  = '[align], [alink], [background], [basefont], [bgcolor],'.
                  '[border], [color], [link], [text], [vlink]';

    $nodes = $crawler->filter($elements);
    
    $nbPb = 0;
    foreach ($nodes as $node)
    {
    	$nbPb++;
    	$this->addResult($node, \Resultat::ECHEC, 'Cet élément est un élément HTML de présentation');
    }

    $nodes = $crawler->filter($attributs);
    foreach ($nodes as $node)
    {
    	$nbPb++;
    	$this->addResult($node, \Resultat::ECHEC, 'Cet élément utilise un attribut de présentation');
    }
    if ($nbPb == 0)
    {
	    $this->addResult(null, \Resultat::REUSSITE, 'Aucun élément ou attribut de présentation');
    }
  }
}