<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AccesLiensTextuelsDoublantZonesCliquablesServeur extends \ASource
{

  const testName = 'Accès aux liens textuels doublant les zones cliquables côté serveur';
  const testId = '6.1';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément possède un attribut ismap ou est utilisé comme image avec zones cliquables
      côté serveur, poursuivre le test, sinon le test est non applicable.'
    ,'Si chaque zone cliquable de l\'élément est doublée d\'un lien textuel permettant d\'accéder
      à la même destination, poursuivre le test, sinon le test est non applicable.'
    ,'Si les liens, regroupés ou non dans la page, sont accessibles directement après l\'élément,
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'F54'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F54'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'img, [input type="image"]';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
        $this->addResult(null, \Resultat::MANUEL, 'Vérifier que l’élément est
        doublé d\'un lien situé juste après');
    }
  }
}
