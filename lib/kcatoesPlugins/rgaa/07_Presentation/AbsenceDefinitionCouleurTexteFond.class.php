<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceDefinitionCouleurTexteFond extends \ASource
{

  const testName = 'Absence de définition d\'une couleur de texte sans définition d\'une couleur de fond et inversement';
  const testId = '7.5';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément est utilisé pour définir une couleur de texte ou une couleur de fond
      (éventuellement via une image de fond), poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément html sur lequel a été définie une couleur de fond a aussi une couleur
      de texte définie (directement ou par héritage css), ou inversement, le test est validé,
      sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'F24'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F24'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
    ,'thematique' => 'Présentation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = '[background],[background-color],[font],[color],[list],[list-style-image]';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
      foreach($nodes as $node)
      {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier qu\'une couleur de
        texte est définie si le fond l\'est aussi et inversement');
      }
    }
  }
}
