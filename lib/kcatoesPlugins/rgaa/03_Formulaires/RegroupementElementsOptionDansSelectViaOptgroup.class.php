<?php
namespace Kcatoes\rgaa;

class RegroupementElementsOptionDansSelectViaOptgroup extends \ASource
{

  const testName = 'Regroupement d\'éléments option dans un élément select via l\'élément optgroup';
  const testId = '3.7';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément ne contient aucun élément optgroup, poursuivre le test, sinon
      le test est non applicable.'
    ,'Si les éléments option contenus dans l\'élément select ne nécessitent pas de
      faire au minimum deux regroupements distincts, le test est validé, sinon le
      test est invalidé.'
  );
  protected static $testDocLinks = array(
    'H85' => 'http://www.w3.org/TR/WCAG20-TECHS/H85'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Formulaires'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
  $crawler = $this->page->crawler;

    $elements  = 'select';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::NA, 'Aucun élément select');
    }

    foreach ($nodes as $node)
    {
    	$bContientOpt = false;
      $options = $node->childNodes;
      foreach($options as $option){
      	if($option->nodeName == 'optgroup'){
      		$bContientOpt = true;
      		break;
      	}
      }
      if ($bContientOpt) {
        $this->addResult($node, \Resultat::NA, 'L\'élément contient des groupes
         d\'options');
      }
      else {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que l\'élément n\'a
        pas besoin d\'au moins deux groupes d\'options');
      }
    }
  }
}
