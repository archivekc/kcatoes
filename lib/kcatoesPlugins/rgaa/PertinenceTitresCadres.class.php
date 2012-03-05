<?php
namespace Kcatoes\rgaa;



class PertinenceTitresCadres extends \ASource
{
	
  const testName = 'Pertinence des titres donnés aux cadres';
  const testId = '1.2';
  protected $testProc = array('Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.'
							,'Si l\'élément contient un attribut title non vide, poursuivre le test, sinon le test est non applicable.'
							,'Si l\'attribut title contient une valeur correspondant au contenu du cadre, le test est validé sinon le test est invalidé');
  protected $testDocLinks = array(
    'H64' => 'http://www.w3.org/TR/WCAG20-TECHS/H64.html'  
  );
	
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'frame, iframe';

    $nodes = $crawler->filter($elements);
    
    $nbNode = 0;
    foreach ($nodes as $node)
    {
		$title = $node->getAttribute('title');
		if (strlen(trim($title)) > 0) {
			$nbNode++;
			$this->addResult($node, \Resultat::MANUEL, 'L\'attribut title est-il pertinent ? : '.$title);
		}
    }

    if ($nbNode == 0)
    {
	    $this->addResult(null, \Resultat::NA, 'Aucune frame ou iframe avec attribut title non vide dans le document');
    }
  }
}
