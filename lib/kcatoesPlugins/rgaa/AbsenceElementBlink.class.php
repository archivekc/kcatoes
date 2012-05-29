<?php
namespace Kcatoes\rgaa;



class AbsenceElementBlink extends \ASource
{
	
  const testName = 'Absence de l\'élément blink';
  const testId = '5.19';
  protected static $testProc = array(
    'Si l\'élément blink est absent, le test est validé, sinon le test est invalidé.' 
  );
  protected static $testDocLinks = array(
    'G11'  => 'http://www.w3.org/TR/WCAG20-TECHS/G11.html', 
    'G186' => 'http://www.w3.org/TR/WCAG20-TECHS/G186.html', 
    'G187' => 'http://www.w3.org/TR/WCAG20-TECHS/G187.html', 
    'F47'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F47.html'
  );

  protected static $testGroups = array(
    'niveau' => 'A'
    ,'thematique' => 'Multimédia'
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;
    
    $elements   = 'blink';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::REUSSITE, 'Il n\'y a pas d\'élément blink');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::ECHEC, 'Il y a un élément blink');
      }
    }

  }
}
