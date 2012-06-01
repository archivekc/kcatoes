<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceDeSimulationVisuelleDeListeNonOrdonnee extends \ASource
{
  const testName = 'Absence de simulation visuelle de liste non ordonnée';
  const testId = '10.5';
  protected static $testProc = array(
    'Si deux segments de texte différents ou identiques sont présents dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si les segments de texte sont mis en forme visuellement par un marqueur de liste
     (-, >, #, *, image ou image de fond représentant un marqueur de liste, etc.),
     poursuivre le test, sinon le test est non applicable.',
    'Si les segments de texte sont regroupés dans un élément ul et qu’ils sont placés
     dans des éléments li, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H48' => 'http://www.w3.org/TR/WCAG20-TECHS/H48'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Structure'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::NA, 'Test non implémenté');
  }
}