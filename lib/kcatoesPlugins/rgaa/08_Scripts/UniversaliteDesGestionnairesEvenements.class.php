<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class UniversaliteDesGestionnairesEvenements extends \ASource
{
  const testName = 'Universalité des gestionnaires d\'évènements';
  const testId = '8.3';
  protected static $testProc = array(
    'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si l\'activation du gestionnaire d\'évènement permet d\'accéder à de l\'information,
     poursuivre le test, sinon le test est non applicable.',
    'Si l\'élément HTML sur lequel est utilisé le gestionnaire d\'évènement possède
     également le gestionnaire d\'évènement qui lui est associé dans la liste suivante :
    onmousedown / onkeydown, onmouseup / onkeyup, onmouseover / onfocus, onmouseout / onblur,
    ou qu\'un autre élément HTML utilisable sans le gestionnaire d\'évènement concerné
     est présent dans le code source de la page pour réaliser une action identique,
      le test est validé, sinon le test est invalidé.'
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
      $this->addResult(null, \Resultat::NA, 'Il n\'y a pas d\'élément ayant des attributs de gestion d\'évènements');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier');
      }
    }
  }
}