<?php
namespace Kcatoes\rgaa;



class PertinenceLegendFieldset extends \ASource
{
	
  const testName = 'A - Pertinence du contenu de l\'élément legend dans l\'élément fieldset';
  const testId = '3.6';
  protected $testProc = array(
    'Si l\'élément mentionné dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.', 
    'Si le contenu de l\'élément legend donne les informations nécessaires pour identifier le contenu de l\'élément fieldset, le test est validé, sinon le test est invalidé.'
  );
  protected $testDocLinks = array(
    'H71' => 'http://www.w3.org/TR/WCAG20-TECHS/H71.html'  
  );
	
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'fieldset legend';

    $nodes = $crawler->filter($elements);
    
    if (count($nodes) == 0)
    {
	    $this->addResult(null, \Resultat::NA, 'Aucune fieldset avec élément legend dans le document');
	    return;
    }

    foreach ($nodes as $node)
    {
			$this->addResult($node, \Resultat::MANUEL, 'L\'élément legend est-il pertinent ? : '.$node->nodeValue);
    }
  }
}
