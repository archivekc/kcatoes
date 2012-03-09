<?php
namespace Kcatoes\rgaa;



class AbsenceElementFormulaireSansIdentifiant extends \ASource
{
  
  const testName = 'A - Absence d\'élément de formulaire sans identifiant';
  const testId = '3.10';
  protected $testProc = array(
    'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si l\'élément n\'a pas d\'attribut title dont la valeur donne la fonction exacte de l\'élément, poursuivre le test, sinon le test est non applicable.',
    'Si l\'élément a un attribut id non vide et unique dans la page, test est validé, sinon le test est invalidé.' 
  );
  protected $testDocLinks = array(
    'H44' => 'http://www.w3.org/TR/WCAG20-TECHS/H44.html'  
  );
  
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'input, textarea, select';
    $inputTypes= array('text', 'password', 'file', 'radio', 'checkbox');
    
    // Identifie l'ensemble des IDs du document
    $allNodes = $crawler->filter('*');
    $allIds = array();
    $multipleIds = array();
    foreach ($allNodes as $node)
    {
      if ($node->hasAttribute('id')){
        $id = trim($node->getAttribute('id'));
        if (!isset($allIds[$id])) {
          $allIds[$id] = $node;
        }
        else {
          $multipleIds[$id][] = $node;
        }
      }
    }

    $nodes = $crawler->filter($elements);
    $nbNode = 0;
    foreach ($nodes as $node)
    {
      $name = $node->nodeName;             // input|textarea|select
      $type = $node->getAttribute('type'); // si input : text|password|file|radio|checkbox
      
      // *** Procédure #1 - élément présent dans la page
      if ( ($name != 'input') || in_array($type, $inputTypes) ) {
        $nbNode++;
        
        // *** Procédure #2 - test attribut title
        $title = $node->getAttribute('title');
        if (strlen(trim($title)) > 0){
          $this->addResult($node, \Resultat::NA, 'L\'élément possède un attribut title');
        }
        else {
          // *** Procédure #3 - test id
          $id = trim($node->getAttribute('id'));
          if (strlen($id) > 0){
            if (! isset($multipleIds[$id])) {
              $this->addResult($node, \Resultat::REUSSITE, 'L\'élément possède un attribut id unique : '.$id);
            }
            else {
              $this->addResult($node, \Resultat::ECHEC, 'L\'élément possède un attribut id, mais il n\'est pas unique : '.$id);
            }
          }
          else {
            $this->addResult($node, \Resultat::ECHEC, 'L\'élément ne possède pas d\'attribut id');
          }
        }
      }
    }
    
    if ($nbNode == 0) {
      $this->addResult(null, \Resultat::NA, 'Aucun élément applicable dans le document '.
                      '(input type="text", input type="password", input type="file", '.
                      'input type="radio", input type="checkbox", textarea, select)');
    }
  }
  
}
