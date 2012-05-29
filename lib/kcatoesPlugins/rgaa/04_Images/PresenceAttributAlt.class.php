<?php
namespace Kcatoes\rgaa;

// TODO : images générées par JavaScript
// TODO : cas des Captcha (validation manuelle ?)

class PresenceAttributAlt extends \ASource
{
	
  const testName = 'Présence de l\'attribut alt';
  const testId = '4.1';
  protected static $testProc = array(
    'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si l\'élément n\'est pas un captcha ou ne fait pas parti d\'un test qui deviendrait inutile si l\'alternative textuelle était présente, poursuivre le test, sinon le test est non applicable.',
    'Si l\'élément possède un attribut alt, le test est validé, sinon le test invalidé.'
  );
  protected static $testDocLinks = array(
    'H37' => 'http://www.w3.org/TR/WCAG20-TECHS/H37.html',
    'F65' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F65.html'
  );
  
  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Images'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'img, area, input[type=image], applet';

    $nodes = $crawler->filter($elements);
    
    foreach ($nodes as $node)
    {
      $alt = trim($node->getAttribute('alt'));
      if (strlen($alt) > 0) {
        $this->addResult($node, \Resultat::REUSSITE, 'L\'élément possède un attribut alt non vide : '.$alt);
      }
      else {
        $this->addResult($node, \Resultat::ECHEC, 'L\'élément ne possède pas d\'attribut alt ou celui-ci est vide');
      }
    }
    
    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::NA, 'Aucun élément img, area, input type="image" ou applet');
    }
    
  }
}
