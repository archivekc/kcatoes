<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceAvertissementOuvertureFenetreObjectEmbed extends \ASource
{

  const testName = 'Présence d\'un avertissement préalable à l\'ouverture de nouvelle fenêtre lors de l\'utilisation d\'éléments object ou embed';
  const testId = '6.25';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'utilisation de l\'élément déclenche l\'ouverture dans une nouvelle fenêtre,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu de l\'élément signale l\'ouverture de la nouvelle fenêtre dans son texte
      ou par ses propriétés, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'F22'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F22'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'object, embed';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que l\'élément
        prévient de l\'ouverture d\'une nouvelle fenêtre dans son texte ou
        ses propriétés');
      }
    }
  }
}
