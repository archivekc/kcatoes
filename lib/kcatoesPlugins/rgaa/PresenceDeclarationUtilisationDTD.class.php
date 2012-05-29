<?php
namespace Kcatoes\rgaa;



class PresenceDeclarationUtilisationDTD extends \ASource
{
  
  const testName = 'Présence de la déclaration d\'utilisation d\'une DTD';
  const testId = '9.1';
  protected static $testProc = array(
    'Si l\'instruction mentionnée dans le champ d\'application est présente dans la page, le test est validé, sinon le test est invalidé.' 
  );
  protected static $testDocLinks = array(
    'G134' => 'http://www.w3.org/TR/WCAG20-TECHS/G134.html'
  );
  
  protected static $testGroups = array(
    'niveau' => 'A'
    ,'thematique' => 'Standards'
  );
  
  public function execute()
  {
    $doctype = $this->page->getDoctype();    
    
    if ($doctype) {
      $this->addResult(null, \Resultat::REUSSITE, 'Il y a une déclaration !DOCTYPE : <br />'.htmlspecialchars($doctype));
    }
    else {
      $this->addResult(null, \Resultat::ECHEC, 'Il n\'y a pas de déclaration !DOCTYPE');
    }
  }
}
