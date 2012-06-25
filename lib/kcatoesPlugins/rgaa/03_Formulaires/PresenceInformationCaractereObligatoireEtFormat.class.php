<?php
namespace Kcatoes\rgaa;

class PresenceInformationCaractereObligatoireEtFormat extends \ASource
{
  const testName = 'Présence d\'information préalable sur le caractère obligatoire de certains champs de saisie et du type/format de saisie attendue si nécessaire';
  const testId = '3.2';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
     poursuivre le test, sinon le test est non applicable. Si l\'élément est soumis à un contrôle
     de saisie avant d\'être traité, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'utilisateur est averti du caractère obligatoire de l\'élément et si nécessaire du
      format ou du type de saisie requis par au moins un des mécanismes suivant :'
    , array( 'indication en début de formulaire et identification des champs par un marqueur distinctif
              situé avant chaque élément de formulaire dans l\'ordre du code source (ou après pour input
              type="checkbox", input type="radio") au sein d\'une balise label associée à l\'élément,'
            ,'indication avant chaque élément de formulaire dans l\'ordre du code source (ou après pour
              input type="checkbox", input type="radio") au sein d\'une balise label associée à l\'élément')
    ,'le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G83'  => 'http://www.w3.org/TR/WCAG20-TECHS/G83'
    ,'G89'  => 'http://www.w3.org/TR/WCAG20-TECHS/G89'
    ,'G184' => 'http://www.w3.org/TR/WCAG20-TECHS/G184'
    ,'H44'  => 'http://www.w3.org/TR/WCAG20-TECHS/H44'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Formulaires'
    ,'profils'    => array('Graphiste', 'Ergonome')
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
      	//On vérifie que l'élément a bien un id
      	if(strlen($node->getAttribute('id')) > 0){
	      	$nodeName = $node->nodeName;
	      	$inputType = $node->getAttribute('type');
	        //Détermination de l'élément
	      	if($inputType == 'checkbox' || $inputType == 'radio'){
	      			//Dans le cas d'une checkbox ou d'un bouton radio, on cherche le label
	      			// après l'élément
      				$this->CheckLabelAfter($node);
	      	}
	      	else{
	      		$this->CheckLabelBefore($node);
	      	}
      	}else{
      		$this->addResult($node, \Resultat::ECHEC, 'Sans id défini, on ne peut
      		trouver un label associé');
      	}
      }
    }
  }

  private function CheckLabelBefore($node){
    $id = $node->getAttribute('id');
    if(null != $node->previousSibling){
    	$sibling = $node->previousSibling;
    	//On vérifie que le noeud précédent est bien un noeud élément
    	if($sibling->nodeType != 1 && $sibling->previousSibling != null){
    		$sibling = $sibling->previousSibling;
    	}
    	if(strtolower($sibling->nodeName) == 'label'){
    		if($sibling->getAttribute('for') == $id){
    			$this->addResult($sibling, \Resultat::MANUEL, 'L\'utilisateur est-il averti
    			du caractère obligatoire de l\'élément '. $node->nodeName . ' qui le
    			suit ?');
    		}
    	}else{
    		$this->addResult($node, \Resultat::ECHEC, 'Pas de label trouvé à proximité, '. $sibling->nodeName);
    	}
    }else{
    	$this->addResult($node, \Resultat::ECHEC, 'Pas de label trouvé à proximité');
    }
  }

  private function CheckLabelAfter($node){
    $id = $node->getAttribute('id');
    if(null != $node->nextSibling){
      $sibling = $node->nextSibling;
      //On vérifie que le noeud suivant est bien un noeud élément
      if($sibling->nodeType != 1 && $sibling->nextSibling != null) $sibling = $sibling->nextSibling;
      if(strtolower($sibling->nodeName) == 'label'){
        if($sibling->getAttribute('for') == $id){
          $this->addResult($sibling, \Resultat::MANUEL, 'L\'utilisateur est-il averti
          du caractère obligatoire de l\'élément '. $node->nodeName . ' qui le
          précède ?');
        }
      }else{
        $this->addResult($node, \Resultat::ECHEC, 'Pas de label trouvé à proximité');
      }
    }else{
      $this->addResult($node, \Resultat::ECHEC, 'Pas de label trouvé à proximité');
    }
  }
}
