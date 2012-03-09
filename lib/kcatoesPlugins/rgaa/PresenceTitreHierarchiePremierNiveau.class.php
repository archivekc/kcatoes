<?php
namespace Kcatoes\rgaa;



class PresenceTitreHierarchiePremierNiveau extends \ASource
{
  
  const testName = 'A - Présence d\'au moins un titre de hiérarchie de premier niveau (h1)';
  const testId = '10.1';
  protected $testProc = array(
    'Si l\'élément mentionné dans le champ d\'application est présent dans la page, le test est validé, sinon le test est invalidé.' 
  );
  protected $testDocLinks = array(
    'H69' => 'http://www.w3.org/TR/WCAG20-TECHS/H69.html'
  );
  
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'h1';

    $nodes = $crawler->filter($elements);
    
    if (count($nodes) > 0) {
      $nodes->rewind();
      $title = $nodes->current();
      $val = trim($title->nodeValue);
      
      if (strlen($val) > 0) {
        $this->addResult($title, \Resultat::REUSSITE, 'Un titre de premier niveau est présent : ' . $val);
        return;
      }
    }

    $this->addResult(null, \Resultat::ECHEC, 'Pas d\'élément titre de premier niveau (h1) dans la page ou celui-ci est vide');
    
  }
}
