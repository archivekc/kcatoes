<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceLectureSonPasArretee extends \ASource
{

  const testName = 'Absence d\'éléments déclenchant la lecture de son ne pouvant pas être arrêtée';
  const testId = '5.29';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément déclenche la lecture de son, poursuivre le test, sinon le test est non applicable.'
    ,'Si le son peut être arrêté ou si sa durée est inférieure ou égale à 3 secondes, le
      test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G60'  => 'http://www.w3.org/TR/WCAG20-TECHS/G60'
    ,'G170' => 'http://www.w3.org/TR/WCAG20-TECHS/G170'
    ,'G171' => 'http://www.w3.org/TR/WCAG20-TECHS/G171'
    ,'F23'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F23'
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

      Tout élément :

          object
          embed
          applet
          tout code javascript utilisé dans la page
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
