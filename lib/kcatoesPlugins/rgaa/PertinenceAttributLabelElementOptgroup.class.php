<?php
namespace Kcatoes\rgaa;



class PertinenceAttributLabelElementOptgroup extends \ASource
{
	
  const testName = 'Pertinence du contenu de l\'attribut label de l\'élément optgroup';
  const testId = '3.9';
  protected $testProc = array(
    'Si l\'élément mentionné dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.', 
    'Si le contenu de l\'attribut label donne les informations nécessaires pour identifier simplement le contenu de l\'élément optgroup, le test est validé, sinon le test est invalidé.');
  protected $testDocLinks = array(
    'H85' => 'http://www.w3.org/TR/WCAG20-TECHS/H85.html'  
  );
  
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements  = 'optgroup';

    $nodes = $crawler->filter($elements);
    
    $nbNode = 0;
    foreach ($nodes as $node)
    {
      $label = $node->getAttribute('label');
      if (strlen(trim($label)) > 0) {
        $nbNode++;
        $this->addResult($node, \Resultat::MANUEL, 'L\'attribut label est-il pertinent ? : '.$label);
      }
    }
    
		if ($nbNode == 0)
		{
      $this->addResult(null, \Resultat::NA, 'Aucun optgroup avec attribut label non vide dans le document');
    }
    
  }
}
