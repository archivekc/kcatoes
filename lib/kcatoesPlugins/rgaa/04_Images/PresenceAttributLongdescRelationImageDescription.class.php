<?php
namespace Kcatoes\rgaa;

//TODO : Gérer les images générées par un javascript

class PresenceAttributLongdescRelationImageDescription extends \ASource
{

  const testName = 'Présence de l\'attribut longdesc pour établir une relation entre une image et sa description longue';
  const testId = '4.9';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément nécessite l\'utilisation d\'une description longue pour être compris,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu immédiatement adjacent à l\'élément ne contient pas un lien permettant
      d\'avoir accès à la description longue de l\'élément, poursuivre le test,
      sinon le test est non applicable.'
    ,'Si l\'élément possède au moins un des mécanismes suivants :'
    ,array(
       'attribut longdesc'
      ,'attribut alt'
    )
    ,'poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu de l\'attribut longdesc ou de l\'attribut alt permet de localiser
      la description longue, le test est validé, sinon le test invalidé.'
  );
  protected static $testDocLinks = array(
     'G73' => 'http://www.w3.org/TR/WCAG20-TECHS/G73'
    ,'H45' => 'http://www.w3.org/TR/WCAG20-TECHS/H45'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Images'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'img';

    $nodes = $crawler->filter($elements);
    $bProcessed = false;
    foreach ($nodes as $node)
    {
        $alt = trim($node->getAttribute('alt'));
        $longdesc = trim($node->getAttribute('longdesc'));
        if (strlen($alt) > 0 || strlen($longdesc) > 0) {
          $this->addResult($node, \Resultat::MANUEL, 'L\'attribut alt ou longdesc
          permet-t-il de localiser la description longue?');
        }
        else {
          $this->addResult($node, \Resultat::NA, 'Attribut alt ou longdesc vide');
        }
    }
  }
}
