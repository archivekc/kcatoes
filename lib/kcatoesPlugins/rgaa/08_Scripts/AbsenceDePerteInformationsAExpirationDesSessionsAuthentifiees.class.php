<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceDePerteInformationsAExpirationDesSessionsAuthentifiees extends \ASource
{
  const testName = 'Absence de perte d\'informations lors de l\'expiration des sessions authentifiées';
  const testId = '8.11';
  protected static $testProc = array(
    'Si l\'un des éléments mentionnés dans le champ d\'application est utilisé sur le site,
     poursuivre le test, sinon le test est non applicable.',
    'Si un mécanisme prévoit l\'expiration ou la fermeture non sollicité de la session,
     poursuivre le test, sinon le test est non applicable.',
    'Si les données saisies par l\'utilisateur avant l\'expiration ou la fermeture non sollicité
     de la session sont conservées après que celui-ci se soit ré-authentifié,
     le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G105' => 'http://www.w3.org/TR/WCAG20-TECHS/G105'
  , 'G181' => 'http://www.w3.org/TR/WCAG20-TECHS/G181'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Scripts'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::MANUEL, 'Vérifier que les données saisies
    par l\'utilisateur avant l\'expiration ou la fermeture non sollicité de la
    session sont conservées après que celui-ci se soit ré-authentifié');
  }
}