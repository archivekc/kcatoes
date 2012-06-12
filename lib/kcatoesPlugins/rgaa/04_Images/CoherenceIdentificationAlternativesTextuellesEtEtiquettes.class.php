<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class CoherenceIdentificationAlternativesTextuellesEtEtiquettes extends \ASource
{

  const testName = 'Cohérence dans l\'identification des alternatives textuelles et des étiquettes de formulaires';
  const testId = '4.11';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément est présent sur plusieurs pages ou plusieurs fois dans une page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si le rôle de l\'élément est identique d\'une page à l\'autre ou plusieurs fois
      dans la même page, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément est identifiable de façon cohérente à chaque fois qu\'il est présent,
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G197' => 'http://www.w3.org/TR/WCAG20-TECHS/G197'
    ,'F31' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F31'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Images'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    /*
      Champ d'application

      Toute barre de navigation.

      Tout élément :

          applet
          object
          img
          input type="image"
          input type="text"
          input type="checkbox"
          input type="file"
          input type="radio"
          input type="password"
          select
          textarea
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
