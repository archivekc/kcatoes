<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class LisibiliteInformationsFondCSSStylesImagesDesactives extends \ASource
{

  const testName = 'Lisibilité des informations affichées comme fond d\'éléments via les styles CSS lorsque les styles et/ou les images sont désactivés';
  const testId = '7.3';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'image de fond de l\'élément apporte de l\'information, poursuivre le test,
      sinon le test est non applicable.'
    ,'Si l\'information apportée par l\'image de fond est lisible lorsque :'
    ,array(
       'les styles sont désactivés'
      ,'les images sont désactivées'
      ,'les styles et les images sont désactivés'
    )
    ,'le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'F3'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F3'
    ,'F24' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F24'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Présentation'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = '[background],[background-image],[list],[list-style-image]';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que si l\'image de
        fond apporte une information, celle-ci reste lisible si les styles et/ou
        les images sont désactivés');
    }
  }
}
