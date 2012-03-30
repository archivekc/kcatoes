<?php
namespace Kcatoes\rgaa;



class AbsenceCadreNonTitres extends \ASource
{
	
  const testName = 'Absence de cadres non titré';
  const testId = '1.1';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément contient un attribut title non vide, le test est validé sinon le test est invalidé');
  protected static $testDocLinks = array(
    'H64' => 'http://www.w3.org/TR/WCAG20-TECHS/H64.html'  
  );
  
  protected static $testGroups = array(
    'niveau' => 'A'
    ,'profil test' => 'Rédacteur'
  );
	
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'frame, iframe';

    $nodes = $crawler->filter($elements);
    
    foreach ($nodes as $node)
    {
			$title = $node->getAttribute('title');
			if (strlen(trim($title)) == 0) {
				$this->addResult($node, \Resultat::ECHEC, 'L\'élément n\'a pas d\'attribut title ou alors celui-ci est vide');
			} else {
				$this->addResult($node, \Resultat::REUSSITE, 'L\'élément a un attribut title non vide : '.$title);
			}
    }

    if (count($nodes) == 0)
    {
	    $this->addResult(null, \Resultat::NA, 'Aucune frame ou iframe dans le document');
    }
  }
}
