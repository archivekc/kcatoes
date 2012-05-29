<?php
namespace Kcatoes\rgaa;



class AbsenceElementMarquee extends \ASource
{
  
  const testName = 'Absence d\'élément marquee';
  const testId = '5.23';
  protected static $testProc = array(
    'Si l\'élément marquee est absent, le test est validé, sinon le test est invalidé.' 
  );
  protected static $testDocLinks = array(
    'G186' => 'http://www.w3.org/TR/WCAG20-TECHS/G186.html',
    'F16'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F16.html'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur')
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
  