<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDesBalisesThPourIndiquerLesEntetesDeLignesEtDeColonnes extends \ASource
{
  const testName = 'Présence des balises th pour indiquer les en-têtes de lignes
   et de colonnes dans les tableaux de données';
  const testId = '11.1';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si l’élément a un ou plusieurs segments de texte pouvant être identifié comme
    en-tête de colonne ou de ligne, poursuivre le test, sinon le test est non applicable .',
    'Si chaque segment de texte est contenu dans un élément th, le test est validé,
     sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H51' => 'http://www.w3.org/TR/WCAG20-TECHS/H51'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Tableaux'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
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
        $bFound = $this->FindTh($node->firstChild);
        if($bFound){
        $this->addResult($node, \Resultat::REUSSITE, 'Des éléments th sont
        présents dans ce tableau');
        }
        else{
          $this->addResult($node, \Resultat::MANUEL, 'Si cet élément est un
          tableau de données, il ne contient pas de balise d\'en-tête');
        }
      }
    }
  }

  private function FindTh($node)
  {
  	$bFound = false;

  	//Est-ce le node que nous cherchons ?
  	if(strtolower($node->nodeName) == 'th'){
  		return true;
  	}else{
  		//On s'assure de ne pas empiéter sur un autre tableau
  		if($node->nodeName != 'table'){
	  		//Sinon on prospecte chez ses enfants...
	  		if($node->firstChild != null){
	  			$bFound = $this->FindTh($node->firstChild);
	  			if($bFound){
	  				return true;
	  			}
	  		}
	  		if(strtolower($node->nodeName) != 'table'){
	  			//...mais aussi chez ses frères
	  			if($node->nextSibling != null){
	  			  $bFound = $this->FindTh($node->nextSibling);
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