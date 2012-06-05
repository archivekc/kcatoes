<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceDeSuppressionDuFocusClavierParDuCodeJavascript extends \ASource
{
  const testName = 'Absence de suppression du focus clavier à l’aide de code javascript';
  const testId = '8.9';
  protected static $testProc = array(
    'Si du code javascript est utilisé dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si le code javascript n’est pas utilisé pour supprimer automatiquement le focus
     lorsqu’un élément le reçoit, le test est validé, sinon le test est invalidé.',
  );
  protected static $testDocLinks = array(
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Scripts'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'applet';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que le code javascript n’est pas
         utilisé pour supprimer automatiquement le focus lorsqu’un élément le
         reçoit.');
    }
  }
}