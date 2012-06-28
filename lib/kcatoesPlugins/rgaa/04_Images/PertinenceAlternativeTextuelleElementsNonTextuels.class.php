<?php
namespace Kcatoes\rgaa;

// TODO : éléments générés par JavaScript

class PertinenceAlternativeTextuelleElementsNonTextuels extends \ASource
{

  const testName = 'Pertinence de l\'alternative textuelle aux éléments non textuels';
  const testId = '4.4';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément n\'est pas contenu dans un élément a ou button, poursuivre le test,
      sinon le test est non applicable.'
    ,'Si l\'élément apporte visuellement une information, poursuivre le test,
      sinon le test est non applicable.'
    ,'Si l\'élément n\'est pas un contenu sonore, visuel animé, multimédias, un captcha ou ne fait
      pas parti d\'un test qui deviendrait inutile si l\'alternative textuelle était présente,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si la totalité de l\'information véhiculée par l\'élément est retranscrite par au moins
      une des solutions suivantes :'
    ,array(
       'le contenu de l\'attribut alt'
      ,'le contenu alternatif avant la fermeture de l\'élément dans le cas de l\'élément object'
      ,'le contenu alternatif dans l\'élément noembed dans le cas de l\'élément embed'
      ,'le contenu de l\'attribut alt d\'une des images d\'un groupe d\'images formant un tout'
      ,'le contenu textuel qui précède ou suit immédiatement l\'élément'
    )
    ,'ou juste une partie de celle-ci lorsqu\'elle est retranscrite en totalité par le contenu
      servant de description longue associé à l\'élément, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G95'  => 'http://www.w3.org/TR/WCAG20-TECHS/G95'
    ,'G194' => 'http://www.w3.org/TR/WCAG20-TECHS/G194'
    ,'F13'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F13'
    ,'F30'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F30'
    ,'F38'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F38'
    ,'F39'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F39'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Images'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'img, applet, object, embed';

    $nodes = $crawler->filter($elements);
    foreach ($nodes as $node)
    {
      $this->addResult($node, \Resultat::MANUEL, 'L’information véhiculée par
        l’élément est retranscrite dans sa description');
    }
  }
}
