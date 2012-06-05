<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceDeChangementsDeContexteSuiteAUneActionUtilisateur extends \ASource
{
  const testName = 'Absence de changements de contexte suite à une action de l’utilisateur
   sans validation explicite ou information préalable';
  const testId = '8.5';
  protected static $testProc = array(
    'Si du code javascript est utilisé dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si le code javascript entraine un changement de contexte (changement d’agent utilisateur,
    déplacement du focus, mise à jour ou génération de contenu qui change le sens d’une page,
     validation de formulaire) dans la page après une action de l’utilisateur, poursuivre le test,
      sinon le test est non applicable.',
    'Si l’utilisateur est averti préalablement du type de changement de contexte que peuvent entraîner
     ces actions par au moins une des solutions suivantes : de façon textuelle, par la mise à disposition
      d’un bouton de validation (input type image, submit, button) validant explicitement le changement
      de contexte, par la mise à disposition d’un lien activable au clavier et à la souris
      (et non à la prise de focus sur l’élément) validant explicitement le changement de contexte
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G13' => 'http://www.w3.org/TR/WCAG20-TECHS/G13'
  , 'G80' => 'http://www.w3.org/TR/WCAG20-TECHS/G80'
  , 'G107' => 'http://www.w3.org/TR/WCAG20-TECHS/G107'
  , 'H32' => 'http://www.w3.org/TR/WCAG20-TECHS/H32'
  , 'H84' => 'http://www.w3.org/TR/WCAG20-TECHS/H84'
  , 'SCR19' => 'http://www.w3.org/TR/WCAG20-TECHS/SCR19'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Scripts'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'applet';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::MANUEL, 'Vérifier qne le texte ne
       contiendrait pas d\'acronymes non définis');
    }
    else {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que l\'utilisateur
        est averti en cas de changement de contexte après une de ses actions.');
    }
  }
}