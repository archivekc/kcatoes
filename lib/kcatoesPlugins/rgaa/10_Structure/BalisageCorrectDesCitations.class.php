<?php
namespace Kcatoes\rgaa;

class BalisageCorrectDesCitations extends \ASource
{
  const testName = 'Balisage correct des citations';
  const testId = '10.8';
  protected static $testProc = array(
    'Si un segment de texte est présent dans la page, poursuivre le test, sinon
    le test est non applicable.',
    'Si le segment de texte est une citation, poursuivre le test, sinon le test est non applicable.',
    'Si le segment de texte est balisé à l\'aide de q pour une citation courte ou de blockquote
     pour un bloc de citation, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H49' => 'http://www.w3.org/TR/WCAG20-TECHS/H49'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Structure'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
  	$crawler = $this->page->crawler;

    $elements   = 'q, blockquote';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Vérifier qu\'aucune citation n\'est
       présente dans la page');
    }
    else {
      foreach($nodes as $node) {
      	if($node->nodeName == 'q'){
          $this->addResult($node, \Resultat::MANUEL, 'Vérifier qu\'il s\'agit bien
          d\'une citation courte');
      	}else{
      		$this->addResult($node, \Resultat::MANUEL, 'Vérifier qu\'il s\'agit bien
          d\'une citation longue');
      	}
      }
    }
  }
}