<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsencePiegeNavigationClavier extends \ASource
{

  const testName = 'Absence de piège lors de la navigation clavier';
  const testId = '6.6';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si lors de la prise de focus sur un élément par l\'intermédiaire d\'une navigation au clavier,
      il est impossible d\'une façon standard (tabulation, flèche, etc) d\'aller à l\'élément précédent
      ou suivant pouvant également recevoir le focus au clavier, poursuivre le test, sinon le test est non applicable.'
    ,'S\'il est indiqué par quelles actions spécifiques il est possible d\'aller à l\'élément précédent
      ou suivant pouvant également recevoir le focus et que ces actions produisent le résultat attendu,
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G21' => 'http://www.w3.org/TR/WCAG20-TECHS/G21'
    ,'H91' => 'http://www.w3.org/TR/WCAG20-TECHS/H91'
    ,'F10' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F10'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
     $this->addResult(null, \Resultat::NON_EXEC, 'Vérifier l\'absence de piège
     lors de la navigation au clavier');
  }
}
