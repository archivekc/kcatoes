<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceSuppressionEffetVisuelFocus extends \ASource
{

  const testName = 'Absence de suppression de l\'effet visuel au focus des éléments';
  const testId = '7.11';
  protected static $testProc = array(
     'Si l\'une des propriétés mentionnées dans le champ d\'application est utilisée dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si cette propriété n\'est pas utilisée pour supprimer l\'effet visuel rendu lorsqu\'un élément
      reçoit le focus, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'C15'  => 'http://www.w3.org/TR/WCAG20-TECHS/C15'
    ,'G165'  => 'http://www.w3.org/TR/WCAG20-TECHS/G165'
    ,'F78'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F78'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Présentation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = '[outline], [outline-color], [outline-style], [outline-width]';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que cette propriété
        n\'est pas utilisée pour supprimer l\'effet visuel rendu lorsqu\'un élément
        reçoit le focus');
    }
  }
}
