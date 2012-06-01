<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceDeComposantsObsoletesParRapportAuxSpecificationsW3C extends \ASource
{
  const testName = 'Absence de composants obsolètes par rapport à la version des spécifications W3C utilisée';
  const testId = '9.5';
  protected static $testProc = array(
    'Si aucun des composants mentionnés dans le champ d’application n’est déclaré obsolète
    par rapport à la version des spécifications du W3C utilisée, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H88' => 'http://www.w3.org/TR/WCAG20-TECHS/H88'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Standards'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::NA, 'Test non implémenté');
  }
}