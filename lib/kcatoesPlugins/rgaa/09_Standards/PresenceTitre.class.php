<?php
namespace Kcatoes\rgaa;



class PresenceTitre extends \ASource
{
  
  const testName = 'Présence d\'un titre dans la page';
  const testId = '9.6';
  protected static $testProc = array(
    'Si l\'élément mentionné dans le champ d\'application est présent dans la page, le test est validé, sinon le test est invalidé.' 
  );
  protected static $testDocLinks = array(
    'G88' => 'http://www.w3.org/TR/WCAG20-TECHS/G88.html',
    'H25' => 'http://www.w3.org/TR/WCAG20-TECHS/H25.html'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Standards'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'title';

    $nodes = $crawler->filter($elements);

    if (count($nodes) > 0) {
      $nodes->rewind();
      $title = $nodes->current();
      $val = trim($title->nodeValue);
      
      if (strlen($val) > 0) {
        $this->addResult($title, \Resultat::REUSSITE, 'L\'élément title est présent : ' . $val);
        return;
      }
    }

    $this->addResult(null, \Resultat::ECHEC, 'Pas d\'élément title dans la page ou celui-ci est vide');
    
  }
}
