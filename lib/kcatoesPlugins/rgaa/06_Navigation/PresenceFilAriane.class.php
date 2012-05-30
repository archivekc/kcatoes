<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceFilAriane extends \ASource
{
  
  const testName = 'Présence d\'un fil d\'ariane';
  const testId = '6.20';
  protected static $testProc = array(
     'Si l\'élément présent dans le champ d\'application est présent dans la page, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G65'  => 'http://www.w3.org/TR/WCAG20-TECHS/G65'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Toute succession ou liste d'éléments a permettant de naviguer dans l'arborescence amenant à la page en cours de consultation.
     */
    $elements   = '';

    $nodes = $crawler->filter($elements);

    /*
      $this->addResult($node, \Resultat::ECHEC, '');
      $this->addResult($node, \Resultat::REUSSITE, '');
      $this->addResult(null,  \Resultat::NA, '');
      $this->addResult($node, \Resultat::MANUEL, '');
      $this->addResult(null, \Resultat::MANUEL, '');
      
      foreach ($nodes as $node)
      {
      }

      if (count($nodes) == 0)
      {
      }
     */
     $this->addResult(null, \Resultat::NON_EXEC, 'Pas implémenté');

  }
}
