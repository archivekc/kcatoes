<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PossibiliteDeDesactiverTouteAlerteNonSollicitee extends \ASource
{
  const testName = 'Possibilité de désactiver toute alerte non sollicitée ou toute mise à jour
   automatique d’un contenu de la page';
  const testId = '8.4';
  protected static $testProc = array(
    'Si du code javascript est utilisé dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si le code javascript provoque une alerte non sollicitée ou met à jour le contenu de la page
     sans action de l’utilisateur, poursuivre le test, sinon le test est non applicable.',
    'Si l’alerte ou la mise à jour n’est pas dûe à un événement ou une situation soudaine et imprévue
     qui exige une action immédiate afin de préserver la santé, la sécurité ou la propriété,
      poursuivre le test, sinon le test est non applicable.',
    'Si l’utilisateur peut désactiver ou activer sur demande les alertes ou la mise à jour,
     le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G75' => 'http://www.w3.org/TR/WCAG20-TECHS/G75'
  , 'G76' => 'http://www.w3.org/TR/WCAG20-TECHS/G76'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Scripts'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::NA, 'Test non implémenté');
  }
}