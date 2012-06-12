<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceElementsClignotementsAutoPasArretes extends \ASource
{

  const testName = 'Absence d\'éléments provoquant des clignotements déclenchés automatiquement ne pouvant pas être arrêtés';
  const testId = '5.20';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément provoque des clignotements qui se déclenchent sans action préalable de
      l\'utilisateur, poursuivre le test, sinon le test est non applicable.'
    ,'Si le clignotements n\'apporte en lui même aucune information ou qu\'il s\'agit d\'une
      fonctionnalité qu\'il serait possible à reproduire sans clignotement, poursuivre le test,
      sinon le test est non applicable.'
    ,'Si l\'utilisateur à le contrôle des clignotements par au moins un des mécanismes suivants :'
    ,array(
       'possibilité d\'arrêter et de reprendre le clignotement'
      ,'la durée du clignotement est inférieure ou égale à 5 secondes'
      ,'possibilité de masquer et de réafficher le contenu clignotant'
      ,'possibilité d\'afficher la totalité du contenu clignotant sans clignotements'
    )
    ,'le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G11'  => 'http://www.w3.org/TR/WCAG20-TECHS/G11'
    ,'G152' => 'http://www.w3.org/TR/WCAG20-TECHS/G152'
    ,'G186' => 'http://www.w3.org/TR/WCAG20-TECHS/G186'
    ,'G187' => 'http://www.w3.org/TR/WCAG20-TECHS/G187'
    ,'F7'   => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F7'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    /*
      Champ d'application

      Tout élément :

          object
          embed
          applet
          img avec l'extension gif , apng ou mng
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
