<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class EquivalenceDeLInformationMiseADispositionDansLaVersionAlternative extends \ASource
{
  const testName = 'Équivalence de l’information mise à disposition dans la version alternative';
  const testId = '12.3';
  protected static $testProc = array(
    'Si l’un des éléments mentionnés dans le champ d’application est présent dans la page,
    poursuivre le test, sinon le test est non applicable.',
    'Si l’élément dispose d’une version alternative, poursuivre le test, sinon le test est non applicable.',
    'Si l’information mise à disposition dans la version alternative est équivalente à
    celle mise à disposition dans la version principale (notamment les informations apportées
    visuellement : textes apparaissant à l’écran, actions visuelles, attitudes ,
    émotions visiblement évidentes, gestes, changements de scène, ou de façon sonore :
    paroles prononcées, bruits, éléments musicaux, intonations, changements d’orateurs),
    le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G69' => 'http://www.w3.org/TR/WCAG20-TECHS/G69'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Textes'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::MANUEL, 'Vérifier que l\'information est
    équivalente entre les différentes versions de la page');
  }
}