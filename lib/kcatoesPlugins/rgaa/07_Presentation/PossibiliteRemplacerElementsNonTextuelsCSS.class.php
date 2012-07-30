<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PossibiliteRemplacerElementsNonTextuelsCSS extends \ASource
{

  const testName = 'Possibilité de remplacer les éléments non textuels par une mise en forme effectuée grâce aux styles CSS';
  const testId = '7.6';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément contient du texte, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément a été défini par la charte graphique du service de communication publique
      en ligne, et que cette définition est ultérieure à publication du RGAA, poursuivre le test,
      sinon le test est non applicable.'
    ,'Si l\'élément n\'est pas un logotype ou purement décoratif, poursuivre le test, sinon le
      test est non applicable.'
    ,'Si la page ne comporte aucun mécanisme de remplacer les éléments non textuels par une
      mise en forme effectuée grâce aux styles CSS, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément utilise une mise en forme ou un effet visuel ne pouvant pas être reproduit
      de façon similaire par des styles CSS, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G140'  => 'http://www.w3.org/TR/WCAG20-TECHS/G140'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Présentation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'img, applet, embed, object, input[type=image]';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
    	foreach($nodes as $node){
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que l\'élément
        utilise une mise en forme ou un effet visuel ne pouvant pas être
        reproduit de façon similaire par des styles CSS');
    	}
    }
  }
}
