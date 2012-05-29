<?php
namespace Kcatoes\rgaa;



class PertinenceContenuTitresHierarchie extends \ASource
{
  
  const testName = 'Pertinence du contenu des titres de hiérarchie';
  const testId = '10.2';
  protected static $testProc = array(
    'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
     poursuivre le test, sinon le test est non applicable.', 
    'Si le contenu de l\'élément permet d\'identifier l\'information qu\'il précède, 
     le test est validé, sinon le test est invalidé.' 
  );
  protected static $testDocLinks = array(
    'G130' => 'http://www.w3.org/TR/WCAG20-TECHS/G130.html',
    'H42'  => 'http://www.w3.org/TR/WCAG20-TECHS/H42.html'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Structure'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'h1, h2, h3, h4, h5, h6';

    $nodes = $crawler->filter($elements);
    
    $nbNode = 0;
    foreach($nodes as $node) {
      $val = trim($node->nodeValue);
      if (strlen($val) > 0) {
        $nbNode++;
        $this->addResult($node, \Resultat::MANUEL, 'Le contenu du titre est-il pertinent ? : ' . $val);
      }
    }

    if ($nbNode == 0) {
      $this->addResult(null, \Resultat::NA, 'Pas de titres de hiérarchie (h1 - h6) dans la page ou ceux-ci sont vides');
    }
    
  }
}
