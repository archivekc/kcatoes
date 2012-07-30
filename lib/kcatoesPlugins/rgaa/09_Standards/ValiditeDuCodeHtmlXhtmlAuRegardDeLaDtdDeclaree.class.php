<?php

namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class ValiditeDuCodeHtmlXhtmlAuRegardDeLaDtdDeclaree extends \ASource
{
  const testName = 'Validité du code HTML / XHTML au regard de la DTD déclarée';
  const testId = '9.4';
  protected static $testProc = array(
    'Si une déclaration d\'utilisation d\'une DTD est présente dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si la page est envoyée sous forme de text/html et qu\'elle est invalide selon la DTD déclarée,
     poursuivre le test, sinon le test est non applicable.',
    'Si les erreurs de validation ne concernent pas l\'imbrication des balises dans l\'arbre du document
     ou l\'écriture des balises et des attributs, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G134' => 'http://www.w3.org/TR/WCAG20-TECHS/G134'
  , 'G192' => 'http://www.w3.org/TR/WCAG20-TECHS/G192'
  , 'H74' => 'http://www.w3.org/TR/WCAG20-TECHS/H74'
  , 'H88' => 'http://www.w3.org/TR/WCAG20-TECHS/H88'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Standards'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $this->addResult(null, \Resultat::NA, 'Test non implémenté');
  }
}