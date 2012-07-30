<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class CoherencePlanSite extends \ASource
{

  const testName = 'Cohérence du plan du site';
  const testId = '6.18';
  protected static $testProc = array(
     'Si la page mentionnée dans le champ d\'application est présente dans le site,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si, sur cette page, les liens exposant la structure générale du site renvoient
      bien vers les pages indiquées par l\'intitulé des liens, le test est validé,
      sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G63'  => 'http://www.w3.org/TR/WCAG20-TECHS/G63'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
     $this->addResult(null, \Resultat::MANUEL, 'S\'assurer que les liens du plan
      du site exposant la structure générale du site renvoient bien vers les
      pages indiquées par l\'intitulé des liens');
  }
}
