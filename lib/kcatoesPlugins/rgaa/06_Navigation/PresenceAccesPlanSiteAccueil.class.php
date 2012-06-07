<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceAccesPlanSiteAccueil extends \ASource
{

  const testName = 'Présence d\'un accès à la page contenant le plan du site depuis la page d\'accueil';
  const testId = '6.19';
  protected static $testProc = array(
     'Si la page mentionnée dans le champ d\'application est présente dans le site,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si au moins un lien, disponible depuis la page d\'accueil du site, pointe vers
      cette page, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G63'  => 'http://www.w3.org/TR/WCAG20-TECHS/G63'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );

  public function execute()
  {
     $this->addResult(null, \Resultat::MANUEL, 'S\'assurer qu\'un lien vers le
     plan du site est disponible depuis la page d\'accueil');
  }
}
