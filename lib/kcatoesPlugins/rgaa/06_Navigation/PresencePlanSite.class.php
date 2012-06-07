<?php
namespace Kcatoes\rgaa;

class PresencePlanSite extends \ASource
{

  const testName = 'Présence d\'une page contenant le plan du site';
  const testId = '6.17';
  protected static $testProc = array(
     'Si aucune page mentionnée dans le champ d\'application n\'est présente dans le site, poursuivre le test, sinon le test est non applicable.'
    ,'Si un moteur de recherche et un menu de navigation sont présent dans le site, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G63'  => 'http://www.w3.org/TR/WCAG20-TECHS/G63'
    ,'G64'  => 'http://www.w3.org/TR/WCAG20-TECHS/G64'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );

  public function execute()
  {
     $this->addResult(null, \Resultat::MANUEL, 'Vérifier qu\'une page avec un
      plan du site existe à moins qu\'elle ne soit remplacée par un moteur de
      recherche ou un menu de navigation');
  }
}
