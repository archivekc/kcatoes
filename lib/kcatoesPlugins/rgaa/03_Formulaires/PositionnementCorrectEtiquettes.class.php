<?php
namespace Kcatoes\rgaa;

class PositionnementCorrectEtiquettes extends \ASource
{
  const testName = 'Positionnement correct des étiquettes par rapport aux champs dans les formulaires';
  const testId = '3.3';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si un segment de texte sert d\'étiquette à l\'élément du champ d\'application,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si le segment de texte est positionné de façon à pouvoir être associé visuellement à
      l\'élément du champ d\'application, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
    'G162' => 'http://www.w3.org/TR/WCAG20-TECHS/G162'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Formulaires'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'input[type=text], input[type=checkbox], input[type=radio],
    input[type=file], input[type=password], select, textarea';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
      foreach($nodes as $node){
          if(strlen($node->getAttribute('name')) >0 ){
	          $this->addResult($node->parentNode, \Resultat::MANUEL, 'Y a-t-il une
	          &eacute;tiquette visuellement associée au contrôle ' .
	          $node->getAttribute('name') . '?');
          }else{
          	$this->addResult($node, \Resultat::MANUEL, 'Y a-t-il une
            &eacute;tiquette visuellement associée à ce contrôle?');
          }
      }
	  }
	}
}
