<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceAutreMoyenQueFormeOuPositionPourIdentifierContenuAuquelEstFaitReferenceTextuellement
 extends \ASource
{
  const testName = 'Présence d’un autre moyen que la forme ou la position pour identifier
  un contenu auquel il est fait référence textuellement';
  const testId = '12.9';
  protected static $testProc = array(
    'Si le segment de texte mentionné dans le champ d’application est présent dans la page,
    poursuivre le test, sinon le test est non applicable.',
    'Si le segment de texte mentionne une forme ou une position et fait référence à un
    contenu de la page ou du site, poursuivre le test, sinon le test est non applicable.',
    'Si le segment de texte permet d’identifier ce contenu par un autre moyen que la forme
    ou la position, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G96' => 'http://www.w3.org/TR/WCAG20-TECHS/G96'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Textes'
    ,'profils'    => array('Développeur', 'Intégrateur','Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::NA, 'Test non implémenté');
  }
}