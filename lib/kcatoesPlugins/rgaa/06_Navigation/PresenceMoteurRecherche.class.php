<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceMoteurRecherche extends \ASource
{
  
  const testName = 'Présence d\'un moteur de recherche';
  const testId = '6.34';
  protected static $testProc = array(
     'Si aucun moteur de recherche n\'est présent dans le site, poursuivre le test, sinon le test est non applicable.'
    ,'Si un plan de site et un menu de navigation sont présent dans le site, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G161'  => 'http://www.w3.org/TR/WCAG20-TECHS/G161'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    
    /*
      $crawler = $this->page->crawler;
      $elements = '';
      $nodes = $crawler->filter($elements);

      $this->addResult($node, \Resultat::ECHEC, '');
      $this->addResult($node, \Resultat::REUSSITE, '');
      $this->addResult(null,  \Resultat::NA, '');
      $this->addResult($node, \Resultat::MANUEL, '');
      
     */
      
     $this->addResult(null, \Resultat::NON_EXEC, 'Pas implémenté');

  }
}
