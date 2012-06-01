<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDeRelationEntreLesEntetesEtLesCellulesDansUnTableauDeDonneesComplexe extends \ASource
{
  const testName = 'Présence d’une relation entre les en-têtes (th) et les cellules (td)
  qui s’y rattachent dans un tableau de données complexe grâce aux attributs id et headers';
  const testId = '11.3';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si les cellules d’en-tête (th) ont un attribut id non vide, et que les cellules (td)
    qui s’y rattachent ont un attribut headers contenant la valeur de ces attributs id,
    le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H43' => 'http://www.w3.org/TR/WCAG20-TECHS/H43'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Tableaux'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::NA, 'Test non implémenté');
  }
}