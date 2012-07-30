<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AbsenceDeSyntaxesCryptiquesParRapportAuContenuDeVotreSite extends \ASource
{
  const testName = 'Absence de syntaxes cryptiques par rapport au contenu de votre site';
  const testId = '12.5';
  protected static $testProc = array(
    'Si un segment de texte est présent dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si le segment de texte est écrit dans une syntaxe ne permettant pas facilement sa compréhension,
    poursuivre le test, sinon le test est non applicable.',
    'Si le segment de texte cryptique a une alternative textuelle permettant sa compréhension,
    par le biais d\'un attribut title ou par un segment de texte adjacent dans une syntaxe
    non cryptique, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H86' => 'http://www.w3.org/TR/WCAG20-TECHS/H86'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Textes'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
   $this->addResult(null, \Resultat::MANUEL, 'Vérifier que du texte cryptique peut
   être compris au travers d\'un attribut title ou un segment de texte adjacent.');
  }
}