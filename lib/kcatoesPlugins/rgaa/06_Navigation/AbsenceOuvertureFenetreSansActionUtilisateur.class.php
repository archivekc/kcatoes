<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceOuvertureFenetreSansActionUtilisateur extends \ASource
{

  const testName = 'Absence d\'ouverture de nouvelles fenêtres sans action de l\'utilisateur';
  const testId = '6.5';
  protected static $testProc = array(
     'Si du code javascript est utilisé dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si le code javascript ne déclenche pas, sans intervention de l\'utilisateur,
      l\'ouverture d\'une nouvelle fenêtre, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G107' => 'http://www.w3.org/TR/WCAG20-TECHS/G107'
    ,'F22'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F22'
    ,'F52'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F52'
    ,'F55'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F55'
    ,'F60'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F60'
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
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que le code
        javascript ne déclenche pas, sans intervention de l’utilisateur,
        l’ouverture d’une nouvelle fenêtre');
    }
  }
}
