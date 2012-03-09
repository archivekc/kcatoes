<?php
namespace Kcatoes\rgaa;



class AbsenceElementMarquee extends \ASource
{
  
  const testName = 'A - Absence d\'élément marquee';
  const testId = '5.23';
  protected $testProc = array(
    'Si l\'élément marquee est absent, le test est validé, sinon le test est invalidé.' 
  );
  protected $testDocLinks = array(
    'G186' => 'http://www.w3.org/TR/WCAG20-TECHS/G186.html',
    'F16'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F16.html'
  );
  
  
  public function execute()
  {
    $crawler = $this->page->crawler;
    
    $elements   = 'marquee';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::REUSSITE, 'Il n\'y a pas d\'élément marquee');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::ECHEC, 'Il y a un élément marquee');
      }
    }

  }
}
  