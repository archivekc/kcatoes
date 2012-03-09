<?php
namespace Kcatoes\rgaa;



class AbsenceLiensSansIntitule extends \ASource
{
  
  const testName = 'A - Absence de liens sans intitulé';
  const testId = '6.16';
  protected $testProc = array(
    'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.', 
    'Si l\'élément n\'est pas un élément a ayant un attribut name ou id, dépourvu d\'attribut href ou ayant un attribut href dont la valeur est égale au caractère # suivi du contenu de l\'attribut name ou id, poursuivre le test, sinon le test est non applicable.', 
    'Si un intitulé peut être obtenu à partir d\'un des cas suivants :', 
        'du contenu textuel de l\'élément', 
        'des alternatives textuelles des éléments graphiques contenus dans l\'élément', 
    'le test est validé, sinon le test est invalidé.'
  );
  protected $testDocLinks = array(
    'G91' => 'http://www.w3.org/TR/WCAG20-TECHS/G91.html', 
    'H30' => 'http://www.w3.org/TR/WCAG20-TECHS/H30.html' 
  );
  
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'a';

    $nodes = $crawler->filter($elements);

    // Parcours des éléments
    foreach ($nodes as $node)
    {
      $name = trim($node->getAttribute('name'));
      $id   = trim($node->getAttribute('id'));
      $href = trim($node->getAttribute('href'));
      
      $hasId   = (strlen($id)   > 0);
      $hasName = (strlen($name) > 0);
      $hasHref = (strlen($href) > 0);
      
      // TODO : vérifier la compréhension de la procédure
      
      if ($hasName) {
        $this->addResult($node, \Resultat::NA, 'L\'élément a un attribut name');
      }
      else if ($hasId) {
        $this->addResult($node, \Resultat::NA, 'L\'élément a un attribut id');
      }
      else if ( ! $hasHref ) {
        $this->addResult($node, \Resultat::NA, 'L\'élément n\'a pas d\'attribut href');
      }
      else if (strcasecmp($href, '#'.$id)   == 0) {
        $this->addResult(null, \Resultat::NA, 'L\'attribut href du lien correspond à # + l\'attribut id');
      }
      else if (strcasecmp($href, '#'.$name)   == 0) {
        $this->addResult(null, \Resultat::NA, 'L\'attribut href du lien correspond à # + l\'attribut name');
      }
      else {
        $text = self::getAllTextNodesOrAltAttr($node);
        if (count($text) > 0) {
          $this->addResult($node, \Resultat::REUSSITE, 'Un intitulé peut être déterminé : ' . implode(' ', $text)); 
        }
        else {
          $this->addResult($node, \Resultat::ECHEC, 'Impossible de déterminer un intitulé pour l\'élément');
        }
      }
    } // fin parcours éléments a
      
    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::NA, 'Aucun lien dans la page');      
    }
    
  } // fin fonction execute
  
  
  
  /**
   * Retourne tous les éléments textuels d'un noeud
   * 
   * @param DOMNode $node
   * @return array
   */
  private static function getAllTextNodesOrAltAttr($node) {
    
    $children = $node->childNodes;
    $return = array();
    foreach($children as $child){

      if ($child->nodeName == '#text') {
        $txt = trim($child->nodeValue);
        if (strlen($txt) > 0) {
          array_push($return, $txt);
        }
      }
      
      else if ($child->nodeName == 'img') {
        $alt = trim($child->getAttribute('alt'));
        if (strlen($alt) > 0) {
          array_push($return, $alt);              
        }
      }
      
      else {
        $return = array_merge($return, self::getAllTextNodesOrAltAttr($child));
      }
    }
    
    return $return;
  }
  
}
