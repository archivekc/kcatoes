<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PossibiliteNaviguerFacilementGroupePages extends \ASource
{

  const testName = 'Possibilité de naviguer facilement dans un groupe de pages';
  const testId = '6.35';
  protected static $testProc = array(
     'Si un groupe de pages est présent dans le site, poursuivre le test, sinon le test est non applicable.'
    ,'Si des liens permettant de naviguer dans ce groupe de pages sont présents, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G64'  => 'http://www.w3.org/TR/WCAG20-TECHS/G64'
    ,'G125'  => 'http://www.w3.org/TR/WCAG20-TECHS/G125'
    ,'G126'  => 'http://www.w3.org/TR/WCAG20-TECHS/G126'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );

  public function execute()
  {
     $this->addResult(null, \Resultat::MANUEL, 'S\'assurer que des liens lient
      les pages d\'un même groupe');
  }
}
