<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AccessibiliteDesDocumentsBureautiquesEnTelechargement extends \ASource
{
  const testName = 'Accessibilité des documents bureautiques en téléchargement';
  const testId = '10.13';
  protected static $testProc = array(
    'Si l’élément mentionné dans le champ d’application est présent dans la page,
    poursuivre le test, sinon le test est non applicable.',
    'Si le document bureautique pointé par l’élément est disponible dans une version
    accessible par le biais d’au moins une des solutions suivantes :
    une version nativement accessible (notamment concernant les alternatives aux images,
    les titres de hiérarchie, les listes, les formulaires, les tableaux de donnée, la langue
    et l’ordre de lecture), une version alternative au format html accessible,
    le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G10' => 'http://www.w3.org/TR/WCAG20-TECHS/G10'
  , 'G135' => 'http://www.w3.org/TR/WCAG20-TECHS/G135'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Structure'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
  	$crawler = $this->page->crawler;

    $elements   = 'a, area, object, embed, applet';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que si l’élément
        pointe vers un document bureautique, celui-ci est disponible sous forme
        native et en html');
      }
    }
  }
}