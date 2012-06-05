<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class UtilisationCorrecteDuRoleDesElements extends \ASource
{
  const testName = 'Utilisation correcte du rôle des éléments';
  const testId = '8.7';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si une interaction avec l’élément (clic de la souris sur l’élément, arrivée ou départ
     du focus sur l’élément) permet de déclencher une action (validation de formulaire,
     accès à une page, ouverture d’une fenêtre, génération de contenu, etc.), poursuivre le test,
     sinon le test est non applicable.',
    'Si cet élément est un élément a, area, button ou input type button, submit, reset, file,
     image, password, radio, checkbox, select, ou qu’un élément de ce type est présent
     dans le code source de la page pour réaliser une action identique, le test est validé,
     sinon le test est invalidé.'
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
    $this->addResult(null, \Resultat::MANUEL, 'Vérifier l\'utilisation correcte
    des éléments HTML de la page permettant de déclencher une action');
  }
}