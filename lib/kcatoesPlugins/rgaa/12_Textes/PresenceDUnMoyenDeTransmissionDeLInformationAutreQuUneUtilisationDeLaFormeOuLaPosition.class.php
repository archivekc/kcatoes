<?php
namespace Kcatoes\rgaa;

class PresenceDUnMoyenDeTransmissionDeLInformationAutreQuUneUtilisationDeLaFormeOuLaPosition extends \ASource
{
  const testName = 'Présence d\'un moyen de transmission de l\'information autre qu\'une utilisation
  de la forme ou la position dans les éléments non textuels';
  const testId = '12.7';
  protected static $testProc = array(
    'Si l\'un des éléments mentionnés dans le champ d\'application est présent ou utilisé dans la page,
    poursuivre le test, sinon le test est non applicable.',
    'Si l\'élément affiche des zones dont leur forme ou leur position donne de l\'information,
    poursuivre le test, sinon le test est non applicable.',
    'Si l\'information transmise par leur forme ou leur position est accessible par un autre moyen
    que leur forme ou leur position , le test est validé sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G96' => 'http://www.w3.org/TR/WCAG20-TECHS/G96'
  ,'G111' => 'http://www.w3.org/TR/WCAG20-TECHS/G111'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Textes'
    ,'profils'    => array('Développeur', 'Intégrateur','Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'img, input[type=image], applet, object, embed';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
    	foreach($nodes as $node){
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que l\'information
        est accessible par un autre moyen');
    	}
    }
  }
}