<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceMenusBarresNavigation extends \ASource
{
  
  const testName = 'Présence de menus ou de barres de navigation';
  const testId = '6.21';
  protected static $testProc = array(
     'Si le site ne comporte ni moteur de recherche ni plan du site, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément mentionné dans le champ d\'application est présent, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'H59'  => 'http://www.w3.org/TR/WCAG20-TECHS/H59'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout groupe d'éléments permettant la navigation dans le site ou dans une page.
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
