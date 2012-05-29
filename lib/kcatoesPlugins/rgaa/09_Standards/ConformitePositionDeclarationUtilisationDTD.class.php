<?php
namespace Kcatoes\rgaa;

use sfContext;

class ConformitePositionDeclarationUtilisationDTD extends \ASource
{
  
  const testName = 'Conformité de la position de la déclaration d\'utilisation d\'une DTD';
  const testId = '9.2';
  protected static $testProc = array(
    'Si l\'instruction mentionnée dans le champ d\'application est présente dans la page, poursuivre le test, sinon le test est non applicable.', 
    'Si l\'instruction est située avant la balise html, le test est validé, sinon le test est invalidé.' 
  );
  protected static $testDocLinks = array(
    'G192' => 'http://www.w3.org/TR/WCAG20-TECHS/G192.html'
  );
  
  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Standards'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $doctype = $this->page->getDoctype();    
    
    if ($doctype) {
      $content = $this->page->__get('content');
      
      $pos_doctype = stripos ($content, '<!DOCTYPE');
      $pos_html    = stripos ($content, '<html');
  
      if ($pos_doctype < $pos_html) {
        $this->addResult(null, \Resultat::REUSSITE, 'La déclaration !DOCTYPE est bien positionnée');
      }
      else {
        $this->addResult(null, \Resultat::ECHEC, 'La déclaration !DOCTYPE n\'est pas positionnée avant l\'élément html');
      }
    }
    else {
      $this->addResult(null, \Resultat::NA, 'Il n\'y a pas de déclaration !DOCTYPE');
    }

  }
}
