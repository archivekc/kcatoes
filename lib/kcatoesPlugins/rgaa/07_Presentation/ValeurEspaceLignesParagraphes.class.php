<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class ValeurEspaceLignesParagraphes extends \ASource
{

  const testName = 'Valeur de l\'espace entre les lignes et entre les paragraphes';
  const testId = '7.17';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément est utilisé pour définir l\'espacement entre les lignes ou entre les paragraphes,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si la valeur de l\'espacement entre les lignes définis est supérieure à 1,5 fois la taille
      du texte et que la valeur de l\'espacement entre les paragraphes est supérieure à 1,5 fois la
      taille de l\'espacement entre les lignes ou qu\'un mécanisme permettant d\'agrandir l\'espacement
      entre les lignes et entre les paragraphes est présent, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'C21'  => 'http://www.w3.org/TR/WCAG20-TECHS/C21'
    ,'G188' => 'http://www.w3.org/TR/WCAG20-TECHS/G188'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Présentation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = '[line-height], [padding], [margin]';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier l\'espace entre les
        lignes et entre les paragraphes');
    }
  }
}
