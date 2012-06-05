<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class LargeurBlocsTexte extends \ASource
{

  const testName = 'Largeur des blocs de textes';
  const testId = '7.16';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément a une largeur inférieure ou égale à 80 caractères (40 glyphes pour le
      Chinois, Japonais ou Coréen) ou si sa largeur peut être réduite à 80 caractères ou moins
      lorsque l\'utilisateur redimensionne la fenêtre de son navigateur, le test est validé,
      sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'C20'  => 'http://www.w3.org/TR/WCAG20-TECHS/C20'
    ,'H87'  => 'http://www.w3.org/TR/WCAG20-TECHS/H87'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Présentation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
     $this->addResult(null, \Resultat::MANUEL, 'Vérifier qu\'un bloc de texte
     a une largeur inférieure ou égale à 80 caractères (40 glyphes pour le
     Chinois, Japonais ou Coréen) ou si sa largeur peut être réduite à 80
     caractères ou moins lorsque l’utilisateur redimensionne la fenêtre de son
     navigateur');
  }
}
