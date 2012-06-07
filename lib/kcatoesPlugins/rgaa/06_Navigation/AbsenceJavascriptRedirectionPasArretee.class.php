<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceJavascriptRedirectionPasArretee extends \ASource
{

  const testName = 'Absence de code javascript provoquant une redirection automatique de la page ne pouvant pas être arrêtée';
  const testId = '6.11';
  protected static $testProc = array(
     'Si du code javascript est utilisé dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si le code javascript provoque une redirection automatique, poursuivre le test, sinon le test est non applicable.'
    ,'Si la redirection automatique ne pourrait être supprimée sans changer fondamentalement
      l\'information ou les fonctionnalités du contenu, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'utilisateur à le contrôle de la redirection automatique par au moins un des mécanismes suivants :'
    ,array(
       'possibilité d\'arrêter la redirection'
      ,'possibilité d\'ajuster librement la durée préalable à la redirection à un minimum de dix fois la durée initialement prévu'
      ,'possibilité d\'étendre, par une action simple, la durée préalable à la redirection pendant une période
        d\'au minimum vingt secondes au préalable à l\'exécution de la redirection'
      ,'le délai préalable à la redirection est supérieur à vingt heures'
    )
    ,'le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'SCR1' => 'http://www.w3.org/TR/WCAG20-TECHS/SCR1'
    ,'SVR1' => 'http://www.w3.org/TR/WCAG20-TECHS/SVR1'
    ,'F58'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F58'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'applet';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
        $this->addResult(null, \Resultat::MANUEL, 'Vérifier que si il y a une
        redirection automatique, celle-ci peut être contrôlée');
    }
  }
}
