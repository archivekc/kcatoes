<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDuneAlternativeAuCodeJavascriptUtilisantUnGestionnaireEvenements extends \ASource
{
  const testName = 'Présence d’une alternative au code javascript utilisant un gestionnaire d\’événements
   sans équivalent universel ou une propriété propre à un périphérique';
  const testId = '8.8';
  protected static $testProc = array(
    'Si du code javascript est utilisé dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si le code javascript utilise un gestionnaire d’événements sans équivalent universel
     ou une propriété propre à un périphérique, poursuivre le test, sinon le test est non applicable.',
    'Si le code javascript est nécessaire pour avoir accès à l’information, poursuivre le test,
     sinon le test est non applicable.',
    'Si l’information disponible grâce au javascript a une alternative accessible
    permettant d’avoir accès à une information équivalente situé dans la page ou atteignable
    depuis la page, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Scripts'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::NA, 'Test non implémenté');
  }
}