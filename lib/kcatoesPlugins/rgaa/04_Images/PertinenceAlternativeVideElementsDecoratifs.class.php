<?php
namespace Kcatoes\rgaa;

class PertinenceAlternativeVideElementsDecoratifs extends \ASource
{
  const testName = 'Pertinence de l\'alternative vide aux éléments décoratifs';
  const testId = '4.5';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément est uniquement décoratif, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément n\'est pas contenu dans un élément a ou button, poursuivre le test,
      sinon le test est non applicable.'
    ,'Si l\'élément possède un attribut alt vide, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'H67' => 'http://www.w3.org/TR/WCAG20-TECHS/H67'
    ,'F38' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F38'
    ,'F39' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F39'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Images'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'img, applet';

    $nodes = $crawler->filter($elements);
    foreach ($nodes as $node)
    {
      $parent = $node->parentNode;
      if($parent->nodeName == 'a' || $parent->nodeName == 'button' ){
        $this->addResult($node, \Resultat::NA, 'Non applicable à cet élément');
      }else{
        $alt = trim($node->getAttribute('alt'));
        if (strlen($alt) > 0) {
          $this->addResult($node, \Resultat::MANUEL, 'Si il s\'agit d\'un
          élément décoratif, le test n\'est PAS validé');
        }
        else {
          $this->addResult($node, \Resultat::MANUEL, 'Si il s\'agit d\'un
          élément décoratif, le test est validé');
        }
      }
    }
  }
}
