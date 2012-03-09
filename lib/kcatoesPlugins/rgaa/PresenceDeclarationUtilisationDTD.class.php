<?php
namespace Kcatoes\rgaa;



class PresenceDeclarationUtilisationDTD extends \ASource
{
  
  const testName = 'Présence de la déclaration d\'utilisation d\'une DTD';
  const testId = '9.1';
  protected $testProc = array(
    'Si l\'instruction mentionnée dans le champ d\'application est présente dans la page, le test est validé, sinon le test est invalidé.' 
  );
  protected $testDocLinks = array(
    'G134' => 'http://www.w3.org/TR/WCAG20-TECHS/G134.html'
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
    
    /*
     * TODO : vérifier la validité du doctype ?
     * (ce n'est pas dans la méthode RGAA)

      $validDoctypes = array(
        'XHTML11'             => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
        'XHTML1_STRICT'       => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
        'XHTML1_TRANSITIONAL' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
        'XHTML1_FRAMESET'     => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
        'XHTML_BASIC1'        => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.0//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd">',
        'XHTML5'              => '<!DOCTYPE html>',
        'HTML4_STRICT'        => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
        'HTML4_LOOSE'         => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
        'HTML4_FRAMESET'      => '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
        'HTML5'               => '<!DOCTYPE html>',
      );
 
     */

  }
}
