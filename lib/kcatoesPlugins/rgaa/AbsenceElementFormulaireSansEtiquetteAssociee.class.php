<?php
namespace Kcatoes\rgaa;



class AbsenceElementFormulaireSansEtiquetteAssociee extends \ASource
{
  
  const testName = 'Absence d\'élément de formulaire sans étiquette associée';
  const testId = '3.11';
  protected $testProc = array(
    'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.', 
    'Si l\'élément n\'a pas d\'attribut title dont la valeur donne la fonction exacte de l\'élément, poursuivre le test, sinon le test est non applicable.', 
    'Si un élément label est présent et possède un attribut for dont le contenu est égal à celui de l\'attribut id de l\'élément mentionné dans le champ d\'application, le test est validé, sinon le test est invalidé.' 
  );
  protected $testDocLinks = array(
    'G82'  => 'http://www.w3.org/TR/WCAG20-TECHS/G82.html', 
    'G131' => 'http://www.w3.org/TR/WCAG20-TECHS/G131.html', 
    'H44'  => 'http://www.w3.org/TR/WCAG20-TECHS/H44.html', 
    'H65'  => 'http://www.w3.org/TR/WCAG20-TECHS/H65.html', 
    'F17'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F17.html', 
    'F68'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F68.html', 
    'F82'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F82.html', 
    'F86'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F86.html'
  );
  
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'input, textarea, select';
    $inputTypes= array('text', 'password', 'file', 'radio', 'checkbox');

    
    // Identifie l'ensemble des attributs for des éléments label du document
    $allLabels = $crawler->filter('label');
    $allFors = array();
    foreach ($allLabels as $label)
    {
      $for = trim($label->getAttribute('for'));
      if (strlen($for) > 0) {
        $allFors[$for] = $label;
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
            if (isset($allFors[$id])) {
              $this->addResult($node, \Resultat::REUSSITE, 'Il existe un élément label associé à l\'élément');
            }
            else {
              $this->addResult($node, \Resultat::ECHEC, 'L\'élément n\'a pas d\'élément label associé');
            }
          }
          else {
            $this->addResult($node, \Resultat::NA, 'L\'élément ne possède pas d\'attribut id');
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
