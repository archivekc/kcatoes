<?php
namespace Kcatoes\rgaa;



class AbsenceDElementFieldsetSansElementLegend extends \ASource
{
  
  const testName = 'Absence d\'élément fieldset sans élément legend';
  const testId = '3.5';
  protected static $testProc = array(
    'Si l\'élément mentionné dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si l\'élément contient un élément legend, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
    'H71' => 'http://www.w3.org/TR/WCAG20-TECHS/H71.html'  
  );
  
  protected static $testGroups = array(
    'niveau' => 'A'
    ,'thematique' => 'Formulaires'
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;
    
    $elements = 'fieldset';

    $nodes = $crawler->filter($elements);
    
    if (count($nodes) == 0)
    {
      $this->addResult(null, \Resultat::NA, 'Aucun fieldset dans le document');
      return;
    }
    
    // Parcours des fieldset
    foreach ($nodes as $node)
    {
    	// Parcours des fils
    	$children = $node->childNodes;
    	$found = false;
    	foreach ($children as $child){
    		if ($child->nodeName == 'legend') { $found = true; break;}
    	}
    	
    	if ($found) { 
    		$this->addResult($node, \Resultat::REUSSITE, 'L\'élément contient un élément legend'); 
    	}
    	else{ 
    		$this->addResult($node, \Resultat::ECHEC, 'L\'élément ne contient pas d\'élément legend');
    	}
    }

  }
}
