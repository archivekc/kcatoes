<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class UniversaliteDuGestionnaireEvenementOnClick extends \ASource
{
  const testName = 'Universalité du gestionnaire d’évènement onclick';
  const testId = '8.2';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si le gestionnaire d’évènement n’est pas utilisé sur un élément a, area, button
     ou input type button, submit, reset, file, image, password, radio, checkbox,
      poursuivre le test, sinon le test est non applicable.',
    'Si l’activation du gestionnaire d’évènement permet d’accéder à de l’information,
     poursuivre le test, sinon le test est non applicable',
    'Si l’élément HTML sur lequel est utilisé le gestionnaire d’évènement onclick possède
     également un gestionnaire d’évènement onkeypress dont l’activation permet d’accéder
      aux mêmes informations ou qu’un autre élément HTML utilisable sans le gestionnaire
       d’évènement concerné est présent dans le code source de la page pour réaliser
        une action identique, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G90' => 'http://www.w3.org/TR/WCAG20-TECHS/G90'
  , 'SCR2' => 'http://www.w3.org/TR/WCAG20-TECHS/SCR2'
  , 'SCR20' => 'http://www.w3.org/TR/WCAG20-TECHS/SCR20'
  , 'SCR29' => 'http://www.w3.org/TR/WCAG20-TECHS/SCR29'
  , 'SCR35' => 'http://www.w3.org/TR/WCAG20-TECHS/SCR35'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Scripts'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
  	$crawler = $this->page->crawler;

    $elements   = 'applet, object, img, input[type=text], input[type=checkbox], input[type=file], input[type=radio], input[type=password], select, textarea';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::NA, 'Il n\'y a pas d\'élément gérant l\'évènement OnClick');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier');
      }
    }
  }
}