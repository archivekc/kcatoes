<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceDeLimiteDeTempsPourCompleterUneTache extends \ASource
{
  const testName = 'Absence de limite de temps pour compléter une tâche';
  const testId = '8.10';
  protected static $testProc = array(
    'Si l’un des éléments mentionnés dans le champ d’application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si l’accomplissement de la tâche est limité dans le temps, poursuivre le test,
     sinon le test est non applicable.',
    'Si la tâche à accomplir doit impérativement être accomplie en temps réel ou si la limite
     de temps ne peut être supprimée sans changer fondamentalement l’information
      ou les fonctionnalités du contenu, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G5' => 'http://www.w3.org/TR/WCAG20-TECHS/G5'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Scripts'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::MANUEL, 'En cas de tâche limitée dans le
     temps à accomplir dans la page, vérifier qu\'elle doit impérativement être
     accomplie en temps réel ou si la limite de temps ne peut être supprimée
     sans changer fondamentalement l’information ou les fonctionnalités du contenu ');
  }
}