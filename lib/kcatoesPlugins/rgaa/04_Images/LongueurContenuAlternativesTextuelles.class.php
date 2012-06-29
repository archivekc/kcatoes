<?php
namespace Kcatoes\rgaa;

class LongueurContenuAlternativesTextuelles extends \ASource
{

  const testName = 'Longueur du contenu des alternatives textuelles';
  const testId = '4.6';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu de l\'attribut alt est non vide, poursuivre le test,
      sinon le test est non applicable.'
    ,'Si le contenu de l\'attribut alt est le plus concis possible,
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G194' => 'http://www.w3.org/TR/WCAG20-TECHS/G194'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Images'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = '[alt]';

    $nodes = $crawler->filter($elements);
    foreach ($nodes as $node)
    {
    	$alt = $node->getAttribute('alt');
    	if(strlen($alt)>0){
    		$this->addResult($node, \Resultat::MANUEL, 'Le texte ('.$alt.') est-il
    		assez concis?');
    	}else{
    	  $this->addResult($node, \Resultat::NA, 'Attribut alt vide');
      }
    }
  }
}
