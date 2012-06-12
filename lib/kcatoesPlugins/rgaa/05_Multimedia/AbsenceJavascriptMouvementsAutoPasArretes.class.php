<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceJavascriptMouvementsAutoPasArretes extends \ASource
{

  const testName = 'Absence de code javascript provoquant des mouvements déclenchés automatiquement ne pouvant pas être arrêtés';
  const testId = '5.25';
  protected static $testProc = array(
     'Si du code javascript est utilisé dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si le code javascript provoque des mouvements qui se déclenchent sans action préalable de l\'utilisateur,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si le mouvement n\'apporte en lui même aucune information ou qu\'il s\'agit d\'une fonctionnalité qu\'il
      serait possible de reproduire sans mouvement, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'utilisateur a le contrôle des mouvements par au moins un des mécanismes suivants :'
    ,array(
       'possibilité d\'arrêter et de reprendre le mouvement'
      ,'la durée du mouvement est inférieure ou égale à 5 secondes'
      ,'possibilité de masquer et de réafficher le contenu mouvant'
      ,'possibilité d\'afficher la totalité du contenu mouvant sans mouvement'
    )
    ,'le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G4'   => 'http://www.w3.org/TR/WCAG20-TECHS/G4'
    ,'G186' => 'http://www.w3.org/TR/WCAG20-TECHS/G186'
    ,'F16'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F16'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Multimédia'
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

     $this->addResult(null, \Resultat::MANUEL, 'Pas implémenté');

  }
}
