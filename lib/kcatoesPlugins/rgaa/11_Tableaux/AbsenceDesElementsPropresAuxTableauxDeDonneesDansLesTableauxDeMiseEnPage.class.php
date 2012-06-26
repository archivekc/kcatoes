<?php
namespace Kcatoes\rgaa;

class AbsenceDesElementsPropresAuxTableauxDeDonneesDansLesTableauxDeMiseEnPage extends \ASource
{
  const testName = 'Absence des éléments propres aux tableaux de données dans
    les tableaux de mise en page';
  const testId = '11.4';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si l’élément ne possède pas d’attribut summary ou possède un attribut summary vide (summary=""),
    et qu’il ne contient aucun des éléments ou attributs suivants: th, caption, thead,
    tfoot, colgroup, scope, headers, axis, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Tableaux'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'table';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::NA, 'Il n\'y a pas de tableau de mise en page');
    }
    else {
      foreach($nodes as $node) {
        $bFound = $this->CheckNode($node);
        if($bFound){
          $this->addResult($node, \Resultat::MANUEL, 'Si il s\'agit d\'un tableau
          de mise en page, le test est validé.');
        }else{
        	$this->addResult($node, \Resultat::MANUEL, 'Si il s\'agit d\'un tableau
          de mise en page, le test est invalidé.');
        }
      }
    }
  }

  private function CheckNode($node)
  {
    $bFound = true;
    $nodeName = strtolower($node->nodeName);

    if($nodeName == 'table'){
        if(strlen($node->getAttribute('summary')) > 0){
         $this->addResult($node, \Resultat::MANUEL, 'L\'attribut summary ne
         devrait pas être rempli dans un tableau de mise en page');
         return false;
        }
    }

    if($nodeName == 'th'){
        $this->addResult($node, \Resultat::MANUEL, 'Un élément d\'en-tête
         ne devrait pas être présent dans un tableau de mise en page');
        return false;
    }

    //Est-ce une cellule de données?
    if($nodeName == 'td'){
    	$attributes = array('headers','axis','scope', );
      //On vérifie l'absence des attributs de la iste ci-dessus
      foreach($attributes as $attribute)
      {
	      if(strlen($node->getAttribute($attribute)) > 0){
	       $this->addResult($node, \Resultat::MANUEL, 'L\'attribut'. $attribut
	        .' ne devrait pas être présent dans une cellule d\'un tableau de mise en page');
	       return false;
	      }
      }
    }

    //Vérifions qu'il ne s'agit pas d'un node indésirable
    $unwantedCells = array('caption','colgroup','thead', 'tfoot');
    foreach($unwantedCells as $cellType){
      if($nodeName == $cellType){
        $this->addResult($node, \Resultat::MANUEL, 'L\'élément '. $nodeName
         . ' ne devrait pas être présent dans un tableau de mise en page');
        return false;
      }
    }

    //Sinon on prospecte chez ses enfants...
    if($node->hasChildNodes())
    {
      $children = $node->childNodes;
      foreach($children as $child){
        if($child->nodeName != 'table' && $child->nodeType == 1){
          $bFound = $this->CheckNode($child);
        }
        if(!$bFound){
          return false;
        }
      }
    }
    return $bFound;
  }
}