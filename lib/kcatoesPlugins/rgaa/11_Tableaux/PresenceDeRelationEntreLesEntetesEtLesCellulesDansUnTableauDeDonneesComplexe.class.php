<?php
namespace Kcatoes\rgaa;

class PresenceDeRelationEntreLesEntetesEtLesCellulesDansUnTableauDeDonneesComplexe extends \ASource
{
  const testName = 'Présence d’une relation entre les en-têtes (th) et les cellules (td)
  qui s’y rattachent dans un tableau de données complexe grâce aux attributs id et headers';
  const testId = '11.3';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si les cellules d’en-tête (th) ont un attribut id non vide, et que les cellules (td)
    qui s’y rattachent ont un attribut headers contenant la valeur de ces attributs id,
    le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H43' => 'http://www.w3.org/TR/WCAG20-TECHS/H43'
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
      $this->addResult(null, \Resultat::NA, 'Il n\'y a pas de tableau de données');
    }
    else {
      foreach($nodes as $node) {
        $headers = array();
        $scope = '';
        $col = 0;
        $row = 0;
        $bHdrActive = false;
        $bFound = $this->CheckNode($node->firstChild, $headers, $scope, $col, $row, $bHdrActive);
        if($bFound){
        $this->addResult($node, \Resultat::REUSSITE, 'Toutes les cellules du tableau
        sont bien en relation avec leurs entêtes');
        }
      }
    }
  }

  private function CheckNode($node, &$headers, &$scope, &$currentCol, &$currentRow, &$bHdrActive)
  {
    $bFound = true;
    $nodeName = strtolower($node->nodeName);

    //Est-ce un nouvelle ligne?
    if($nodeName == 'tr'){
      $currentRow = $currentRow + 1;
      $currentCol = 0;
    }

    //Est-ce une cellule de données?
    if($nodeName == 'td'){
    	//La déclaration des headers est finie, on les rend actifs
    	if(!$bHdrActive){
    		$bHdrActive = true;
    	}
      $currentCol = $currentCol + 1;
      //On vérifie son attribut headers
      if(strlen($node->getAttribute('headers'))>0){
        if( $scope == 'col'){
            if( $headers[$currentCol] == $node->getAttribute('headers')){
              //On ne veut valider le tableau qu'en s'étant assuré que toutes les
              // cellules sont correctement formatées
              if($node->firstChild == null && null == $node->nextSibling){
                return true;
              }else{
                $bFound = true;
              }
            }else{
              //mauvais header
              $this->addResult($node, \Resultat::ECHEC, 'Mauvais header, valeur
	              attendue :' . $headers[$currentCol]);
              return false;
            }
          }elseif($scope == 'row'){
            if( $headers[$currentRow] == $node->getAttribute('headers')){
              //On ne veut valider le tableau qu'en s'étant assuré que toutes les
              // cellules sont correctement formatées
              if($node->firstChild == null && null == $node->nextSibling){
                return true;
              }else{
                $bFound = true;
              }
            }else{
              //mauvais header
              $this->addResult($node, \Resultat::ECHEC, 'Mauvais header, valeur
              attendue :' . $headers[$currentRow]);
              return false;
            }
          }
      }else{
        //pas de headers
        $this->addResult($node, \Resultat::ECHEC, 'Pas d\'attribut headers');
        return false;
      }
    }

    //On s'assure de ne pas empiéter sur un autre tableau
    if($nodeName != 'table'){
      //Sinon on prospecte chez ses enfants...
      if($node->hasChildNodes())
      {
        $children = $node->childNodes;
        foreach($children as $child)
        {
        	$childName = strtolower($child->nodeName);
          //Est-ce un node d'en-tête ?
          if($childName == 'th'){
            $bFound = $this->CheckNodeTH($child, $headers, $scope, $currentCol, $currentRow, $bHdrActive);
          } elseif($childName == 'tr' || $childName == 'td'){
            $bFound = $this->CheckNode($child, $headers, $scope, $currentCol, $currentRow, $bHdrActive);
          }
          if(!$bFound){
            return false;
          }
        }
      }

      //...mais aussi chez les frères des éléments TR puisque leurs enfants sont déjà passés en revue
      if($node->nextSibling != null){
        $sibling = $node->nextSibling;
        $siblingName = strtolower($sibling->nodeName);
        if($siblingName == 'tr'){
          $bFound = $this->CheckNode($sibling, $headers, $scope, $currentCol, $currentRow, $bHdrActive);
        }
        if(!$bFound) return false;

        $unwantedCells = array('tbody','caption','colgroup','thead','tfoot');
        foreach($unwantedCells as $cellType){
          if($siblingName == $cellType){
            $this->addResult($sibling, \Resultat::NA, 'Elément non applicable à ce test');
            return false;
          }
        }
      }
    }
    return $bFound;
  }

  private function CheckNodeTH ($node, &$headers, &$scope, &$currentCol, &$currentRow, &$bHdrActive)
  {
      $currentCol = $currentCol + 1;
      //Si les headers sont déjà actifs, il y a du renouvellement dans l'air
      if($bHdrActive){
      	$bHdrActive = false;
      	//On réinitialise le tableau des headers
      	$headers = array();
      }

      if(strlen($node->getAttribute('scope'))>0){
        //le scope a-t-il été déjà défini ?
        if(strlen($scope) == 0){
          $scope = strtolower($node->getAttribute('scope'));
          //On s'assure que le scope est correctement défini
          $scopeValues = array('row', 'col', 'rowgroup', 'colgroup');
          $bOK = false;
          foreach($scopeValues as $value){
          	if($scope ==  $value){
          		$bOK = true;
          		break;
          	}
          }
          if(!$bOK){
            $this->addResult($node, \Resultat::ECHEC, 'Le scope n\'a pas une valeur
             attendue');
            return false;
          }
          elseif ($scope == 'rowgroup' || $scope == 'colgroup'){
            $this->addResult($node, \Resultat::NA, 'Test non applicable');
            return false;
          }
        }else{
          //On s'assure que le scope est consistant au sein du tableau
          if( $scope != strtolower($node->getAttribute('scope'))){
            $this->addResult($node, \Resultat::ECHEC, 'Le scope a déjà été défini
             avec la valeur ' . $scope);
            return false;
          }
        }
        //Maintenant que le scope est traité, on passe à l'id de ce scope
        if(strlen($node->getAttribute('id'))>0){
          if( $scope == 'col'){
            $headers[$currentCol] = $node->getAttribute('id');
          }elseif($scope == 'row'){
            $headers[$currentRow] = $node->getAttribute('id');
          }
        }else{
          //pas d'id d'en-tête
          $this->addResult($node, \Resultat::ECHEC, 'Pas d\'id d\'en-tête');
          return false;
        }
      }else{
        //pas de scope
        $this->addResult($node, \Resultat::ECHEC, 'Pas de scope');
        return false;
      }
      return true;
  }
}