<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceDeTableauxDeDonneesOuDeColonnesFormatesALAideDeTexte extends \ASource
{
  const testName = 'Absence de tableaux de données ou de colonnes formatés à l’aide de texte';
  const testId = '11.5';
  protected static $testProc = array(
    'Si l’un des éléments mentionnés dans le champ d’application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si l’élément n’est pas utilisé afin de formater visuellement des colonnes ou un tableau de données,
    le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Tableaux'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur','Contributeur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::NA, 'Test non implémenté');
  }
}