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


class AbsenceDAttributsOuDElementsHtmlDePresentation2 extends \ASource
{
	
  const testName = 'Absence d\'attribut ou d\'élément HTML de présentation2';
  const testId = '7.8';
  protected $testProc = array('Si aucun des éléments mentionnés dans le champ d\'application n\'est présent dans la page, le test est validé, sinon le test est invalidé.');
  protected $testDocLinks = array(
    'G140' => 'http://www.w3.org/TR/WCAG20-TECHS/G140.html'  
  );
	
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'basefont, blink, center, font, marquee, s, strike, tt, u, p';
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