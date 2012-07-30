<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceApparitionBarreDefilementHorizontalePleinEcran extends \ASource
{

  const testName = 'Absence d\'apparition de barre de défilement horizontale en affichage plein écran';
  const testId = '7.15';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si en affichage plein écran une barre de défilement horizontale apparaît,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si un mécanisme permettant de changer la mise en forme permet d\'afficher le contenu
      sans barre de défilement, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'C24' => 'http://www.w3.org/TR/WCAG20-TECHS/C24'
    ,'C26' => 'http://www.w3.org/TR/WCAG20-TECHS/C26'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Présentation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
     $this->addResult(null, \Resultat::MANUEL, 'Vérifier qu\'un un mécanisme
     permet de changer la mise en forme permet d\'afficher le contenu sans barre
     de défilement en affichage plein écran' );
  }
}
