<?php
namespace Kcatoes\rgaa;

class PresenceDUnTitrePourLesTableauxDeDonnees extends \ASource
{
  const testName = 'Présence d’un titre pour les tableaux de données';
  const testId = '11.7';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
    poursuivre le test, sinon le test est non applicable.',
    'Si est présent un élément caption, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H39' => 'http://www.w3.org/TR/WCAG20-TECHS/H39'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Tableaux'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'table';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::NA, 'Il n\'y a pas de tableau de données');
    }
    else {
      foreach($nodes as $node) {
      	$bFound = $this->FindCaption($node);
      	if($bFound){
      		$this->addResult($node, \Resultat::MANUEL, 'Si il s\'agit d\'un tableau
      		de données, le test est validé');
      	}else{
      		$this->addResult($node, \Resultat::MANUEL, 'Si il s\'agit d\'un tableau
          de données, le test n\'est PAS validé ');
      	}
      }
    }
  }

  private function FindCaption($node)
  {
    $bFound = false;
    $nodeName = strtolower($node->nodeName);
    //Est-ce le node que nous cherchons ?
    if($nodeName == 'caption'){
      return true;
    }else{
       //On prospecte chez ses enfants...
       if($node->hasChildNodes()){
        $children = $node->childNodes;
        foreach($children as $child){
        	if($child->nodeName != 'table' && $child->nodeType == 1){
	        	$bFound = $this->FindCaption($child);
	          if($bFound){
	            return true;
	          }
        	}
        }
      }
    }
    return $bFound;
  }
}