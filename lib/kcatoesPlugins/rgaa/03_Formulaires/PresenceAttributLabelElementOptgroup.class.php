<?php
namespace Kcatoes\rgaa;



class PresenceAttributLabelElementOptgroup extends \ASource
{
	
  const testName = 'Présence d\'un attribut label sur l\'élément optgroup';
  const testId = '3.8';
  protected static $testProc = array(
    'Si l\'élément mentionné dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.', 
    'Si l\'élément possède un attribut label, le test est validé, sinon le test est invalidé.');
  protected static $testDocLinks = array(
    'H85' => 'http://www.w3.org/TR/WCAG20-TECHS/H85.html'  
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Formulaires'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements  = 'optgroup';

    $nodes = $crawler->filter($elements);
    
    if (count($nodes) == 0) {
    	$this->addResult(null, \Resultat::NA, 'Aucun élément optgroup');
    }
    
    foreach ($nodes as $node)
    {
      $label = $node->getAttribute('label');
      if (strlen(trim($label)) == 0) {
        $this->addResult($node, \Resultat::ECHEC, 'L\'élément n\'a pas d\'attribut label ou alors celui-ci est vide');
      }
      else {
        $this->addResult($node, \Resultat::REUSSITE, 'L\'élément a un attribut label non vide : '.$label);
      }
    }
    
  }
}
