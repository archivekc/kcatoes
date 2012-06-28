<?php
namespace Kcatoes\rgaa;

// TODO : images générées par JavaScript
// TODO : cas des Captcha (validation manuelle ?)

class PertinenceAlternativeTextuelleImagesLiens extends \ASource
{

  const testName = 'Pertinence de l\'alternative textuelle aux images liens';
  const testId = '4.2';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément est contenu dans un élément a ou button, poursuivre le test,
      sinon le test est non applicable.'
    ,'Si l\'élément n\'est pas utilisé comme captcha ou ne fait pas partie d\'un test
      qui deviendrait inutile si l\'alternative textuelle était présente, poursuivre
      le test, sinon le test est non applicable, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément possède un attribut alt, poursuivre le test, sinon le test
      est non applicable.'
    ,'Si le contenu de l\'attribut alt seul ou associé au contenu textuel qui
      précède ou suit immédiatement l\'élément img (dans l\'élément a) permet d\'identifier
      la destination du lien ou l\'action déclenchée, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Images'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'img';

    $nodes = $crawler->filter($elements);
    $bProcessed = false;
    foreach ($nodes as $node)
    {
    	$parent = $node->parentNode;
    	if($parent->nodeName == 'a' || $parent->nodeName == 'button' ){
	    	$bProcessed = true;
    		$alt = trim($node->getAttribute('alt'));
	      if (strlen($alt) > 0) {
	        $this->addResult($node, \Resultat::MANUEL, 'L\'attribut alt ('.$alt.')
	        permet-t-il d’identifier la destination du lien ou l’action déclenchée?');
	      }
	      else {
	        $this->addResult($node, \Resultat::MANUEL, 'Y a-t-il un contenu textuel
	        attenant à l\'image qui permettrait d’identifier la destination du lien
	        ou l’action déclenchée?');
	      }
    	}
    }

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::NA, 'Aucun élément img');
    }elseif(!$bProcessed){
    	$this->addResult(null, \Resultat::NA, 'Aucun des éléments img trouvés n\'est
    	applicable au test');
    }
  }
}
