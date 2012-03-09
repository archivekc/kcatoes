<?php
namespace Kcatoes\rgaa;



class ConformiteSyntaxiqueDeclarationUtilisationDTD extends \ASource
{
  
  const testName = 'A - Conformité syntaxique de la déclaration d\'utilisation d\'une DTD';
  const testId = '9.3';
  protected $testProc = array(
    'Si l\'instruction mentionnée dans le champ d\'application est présente dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si l\'instruction est déclarée selon une syntaxe validée par le W3C (voir la liste des DTD recommandées, recommended list of DTDs ), le test est validé, sinon le test est invalidé.' 
  );
  protected $testDocLinks = array(
    'H74' => 'http://www.w3.org/TR/WCAG20-TECHS/H74.html'
  );
  
  
  public function execute()
  {
    $doctype = $this->page->getDoctype();    
    
    if ($doctype) {
      
      $validDoctypes = array(
        '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">',
        '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
        '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">',
        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.0//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd">',      
        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">', 
        '<!DOCTYPE html>',
      );
      
      if (in_array($doctype, $validDoctypes)){
        $this->addResult(null, \Resultat::REUSSITE, 'La déclaration !DOCTYPE est valide : <br />' . htmlspecialchars($doctype));
      }
      else {
        $this->addResult(null, \Resultat::ECHEC, 'La déclaration !DOCTYPE n\'est pas valide : <br />' . htmlspecialchars($doctype));
      }
    }
    
    else {
      $this->addResult(null, \Resultat::NA, 'Il n\'y a pas de déclaration !DOCTYPE');
    }

  }
}
