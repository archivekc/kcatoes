<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDIndicationDesChangementsDeLangueDansLeTexte extends \ASource
{
  const testName = 'Présence d’un titre pour les tableaux de données';
  const testId = '12.1';
  protected static $testProc = array(
    'Si un segment de texte mentionné dans le champ d’application est présent dans la page,
    poursuivre le test, sinon le test est non applicable.',
    'Si le segment de texte constitue un changement de langue par rapport à la langue principale
     de la page ou à celle du contenu de son élément HTML parent, poursuivre le test,
     sinon le test est non applicable.',
    'Si le segment de texte n’est pas un nom propre, un mot/groupe de mots dans une langue
    indéterminée, un mot/groupe de mots pouvant être identifiés s’il est prononcé dans la langue
    du contexte ou un mot/groupe de mots passé dans le langage courant de la langue du contexte,
    poursuivre le test, sinon le test est non applicable.',
    'Si le segment de texte est le seul contenu d’un élément HTML ascendant ayant un attribut lang
    (ou xml:lang pour du XML ou du XHTML 1.1) correctement renseigné, le test est validé,
    sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'H58' => 'http://www.w3.org/TR/WCAG20-TECHS/H58'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Textes'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'lang';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
      $this->addResult(null, \Resultat::MANUEL, 'Vérifier que l\'absence de
      traitement de langue soit justifiée.');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que l\'indication
        de changement de langue correspond bien au langage utilisé dans le texte
        balisé concerné');
      }
    }
  }
}