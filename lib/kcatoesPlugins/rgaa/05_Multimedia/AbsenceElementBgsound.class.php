<?php
namespace Kcatoes\rgaa;



class AbsenceElementBgsound extends \ASource
{
  
  const testName = 'Absence d\'élément bgsound';
  const testId = '5.30';
  protected static $testProc = array(
    'Si l\'élément bgsound est absent ou qu\'il diffuse un son dont la durée est inférieure ou égale à 3 secondes, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
    'G60'  => 'http://www.w3.org/TR/WCAG20-TECHS/G60.html', 
    'G171' => 'http://www.w3.org/TR/WCAG20-TECHS/G171.html'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'bgsound';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::REUSSITE, 'Il n\'y a pas d\'élément bgsound');
    }
    else {
      foreach ($nodes as $node)
      {
        $loop = trim($node->getAttribute('loop'));
        
        if ($loop == '-1' || $loop == -1 || strcasecmp($loop, 'infinite')==0 ) {
          $this->addResult($node, \Resultat::ECHEC, 'Il y a un élément bgsound dont la répétition est infinie');          
        }
        else {
          $this->addResult($node, \Resultat::MANUEL, 'La durée de lecture du son est-elle inférieure à 3 secondes ?');
        }
      }
    }

  }
}
