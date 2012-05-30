<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceJavascriptRafraichissementPasArrete extends \ASource
{
  
  const testName = 'Absence de code javascript provoquant un rafraîchissement automatique de la page ne pouvant pas être arrêté';
  const testId = '6.8';
  protected static $testProc = array(    
     'Si du code javascript est utilisé dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si le code javascript provoque un rafraîchissement automatique de la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si le rafraîchissement automatique ne pourrait être supprimée sans changer fondamentalement 
      l\'information ou les fonctionnalités du contenu, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'utilisateur à le contrôle du rafraîchissement par au moins un des mécanismes suivants :'
    ,array(
       'possibilité d\'arrêter et de reprendre le rafraîchissement'
      ,'possibilité d\'ajuster librement la durée de rafraîchissement à un minimum de dix fois la durée initialement prévu'
      ,'possibilité d\'étendre, par une action simple, la durée de rafraîchissement pendant une période 
        d\'au minimum vingt secondes au préalable à l\'exécution du rafraîchissement'
      ,'le délai de rafraîchissement est supérieur à vingt heures'
    )
    ,'le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'F61'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F61'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    /*
      Champ d'application
      
      Tout code javascript utilisé dans la page.
     */
    
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
