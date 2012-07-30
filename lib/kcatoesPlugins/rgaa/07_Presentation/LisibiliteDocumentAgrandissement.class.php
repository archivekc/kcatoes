<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class LisibiliteDocumentAgrandissement extends \ASource
{

  const testName = 'Lisibilité du document en cas d\'agrandissement de la taille du texte';
  const testId = '7.13';
  protected static $testProc = array(
     'Si lorsque l\'utilisateur n\'a pas modifié la taille du texte par défaut de son navigateur,
      le document reste lisible sans perte d\'information avec la taille du texte augmentée à 200%,
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'F69'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F69'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Présentation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
     $this->addResult(null, \Resultat::MANUEL, 'Vérifier que le document reste lisible sans
      perte d\'information avec la taille du texte augmentée à 200%');
  }
}
