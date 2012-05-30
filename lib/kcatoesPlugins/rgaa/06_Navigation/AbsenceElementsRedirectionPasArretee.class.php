<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceElementsRedirectionPasArretee extends \ASource
{
  
  const testName = 'Absence d\'éléments provoquant une redirection automatique de la page ne pouvant pas être arrêtée';
  const testId = '6.12';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément provoque une redirection automatique de la page, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si la redirection automatique ne pourrait être supprimée sans changer fondamentalement 
      l\'information ou les fonctionnalités du contenu, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'utilisateur à le contrôle de la redirection automatique par au moins un des mécanismes suivants :
        possibilité d\'arrêter la redirection
        possibilité d\'ajuster librement la durée préalable à la redirection à 
          un minimum de dix fois la durée initialement prévu
        possibilité d\'étendre, par une action simple, la durée préalable à la redirection 
          pendant une période d\'au minimum vingt secondes au préalable à l\'exécution de la redirection
        le délai préalable à la redirection est supérieur à vingt heures
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'F58'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F58'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Tout élément :
      
          script coté serveur (expiration de session, entête http refresh)
          applet
          object
          embed
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
