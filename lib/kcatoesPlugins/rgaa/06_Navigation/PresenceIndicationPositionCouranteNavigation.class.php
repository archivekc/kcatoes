<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceIndicationPositionCouranteNavigation extends \ASource
{
  
  const testName = 'Présence d\'une indication de la position courante dans la navigation';
  const testId = '6.36';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément indique par une mise forme différente la page en cours de consultation, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G128'  => 'http://www.w3.org/TR/WCAG20-TECHS/G128'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Graphiste', 'Ergonome')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Toute barre de navigation.
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
