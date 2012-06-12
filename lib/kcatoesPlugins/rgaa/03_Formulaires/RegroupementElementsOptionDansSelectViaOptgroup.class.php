<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class RegroupementElementsOptionDansSelectViaOptgroup extends \ASource
{

  const testName = 'Regroupement d\'éléments option dans un élément select via l\'élément optgroup';
  const testId = '3.7';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément ne contient aucun élément optgroup, poursuivre le test, sinon
      le test est non applicable.'
    ,'Si les éléments option contenus dans l\'élément select ne nécessitent pas de
      faire au minimum deux regroupements distincts, le test est validé, sinon le
      test est invalidé.'
  );
  protected static $testDocLinks = array(
    'H85' => 'http://www.w3.org/TR/WCAG20-TECHS/H85'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Formulaires'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {

    /*
      Champ d'application

      Tout élément select.
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
