<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceElementsRafraichissementPasArrete extends \ASource
{

  const testName = 'Absence d\'éléments provoquant un rafraîchissement automatique de la page ne pouvant pas être arrêté';
  const testId = '6.9';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément provoque un rafraîchissement automatique de la page, poursuivre le test,
      sinon le test est non applicable.'
    ,'Si le rafraîchissement automatique ne pourrait être supprimée sans changer fondamentalement
      l\'information ou les fonctionnalités du contenu, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'utilisateur à le contrôle du rafraîchissement par au moins un des mécanismes suivants :'
    ,array(
       'possibilité d\'arrêter et de reprendre le rafraîchissement'
      ,'possibilité d\'ajuster librement la durée de rafraîchissement à un minimum de dix fois la durée initialement prévu'
      ,'possibilité d\'étendre, par une action simple, la durée de rafraîchissement pendant une période d\'au minimum
        vingt secondes au préalable à l\'exécution du rafraîchissement'
      ,'le délai de rafraîchissement est supérieur à vingt heures'
    )
    ,'le test est validé, sinon le test est invalidé.'
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

    $elements = 'applet, object, embed';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
        $this->addResult(null, \Resultat::MANUEL, 'Vérifier que si il y a un
        rafraîchissement automatique, celui-ci peut être contrôlé');
    }
  }
}
