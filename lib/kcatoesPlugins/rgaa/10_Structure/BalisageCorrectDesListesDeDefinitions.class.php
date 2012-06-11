<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class BalisageCorrectDesListesDeDefinitions extends \ASource
{
  const testName = 'Balisage correct des listes de définitions';
  const testId = '10.7';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
    poursuivre le test, sinon le test est non applicable.',
    'Si chaque élément dd est précédé (de façon immédiatement ou non) d’un élément dt,
     le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H40' => 'http://www.w3.org/TR/WCAG20-TECHS/H40'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Structure'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'dd';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
      foreach($nodes as $node) {
      	$bFound = false;
        $tmpNode = $node;

        $parent = $node->parentNode;
        if($parent->nodeName == 'dl'){
	        //On passe les aînés en revue pour vérifier le balisage
	        do{
	          $sibling = $tmpNode->previousSibling;

	          if($sibling != null){
		          //Cet aîné est-il celui qu'on cherche ?
		          if($sibling->nodeName == 'dt'){
		            $bFound = true;
		          }

		          //Ce cas détermine le balisage incorrect des définitions
		          if($sibling->nodeName == 'dd'){
		            break;
		          }
	          }

	          //On remonte d'un cran
	          $tmpNode = $sibling;
	        }while ($bFound == false && $tmpNode != null);

	        if($bFound){
	          $this->addResult($node, \Resultat::REUSSITE, 'Cet élément dd est bien
	          précédé d\'un élément dt.');
	        }else{
	          $this->addResult($node, \Resultat::ECHEC, 'Cet élément dd n\'est pas
	          précédé d\'un élément dt.');
	        }
        }else{
        $this->addResult($node, \Resultat::ECHEC, 'Cet élément dd n\'est pas
            contenu dans un élément dl.');
        }
	    }
    }
  }
}