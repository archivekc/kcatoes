<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class BalisageCorrectDesAbreviationsPresentesDansLaPage extends \ASource
{
  const testName = 'Balisage correct des abréviations présentes dans la page';
  const testId = '10.9';
  protected static $testProc = array(
    'Si un segment de texte mentionné dans le champ d’application est présent dans la page,
     poursuivre le test, sinon le test est non applicable.',
    'Si au minimum lors la première occurrence de chaque segment de texte, rencontrée
     dans l’ordre du code source de la page, l’utilisateur n’a pas accès à la version
      non abrégée du segment de texte par au moins un des mécanismes suivants :
    la version non abrégée du segment de texte est donnée de façon adjacente à celui ci,
    le segment de texte est un lien vers sa version non abrégée,
    le segment de texte est un lien avec un attribut title donnant sa version non abrégée,
    un glossaire donnant la version non abrégée du segment de texte est présent sur le site,
     poursuivre le test, sinon le test est non applicable.',
    'Si au minimum la première occurrence du segment de texte est contenue dans un élément abbr
     avec un attribut title non vide, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'G55' => 'http://www.w3.org/TR/WCAG20-TECHS/G55'
  , 'G70' => 'http://www.w3.org/TR/WCAG20-TECHS/G70'
  , 'G97' => 'http://www.w3.org/TR/WCAG20-TECHS/G97'
  , 'H28' => 'http://www.w3.org/TR/WCAG20-TECHS/H28'
  , 'H60' => 'http://www.w3.org/TR/WCAG20-TECHS/H60'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Structure'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {

    $crawler = $this->page->crawler;

    $elements   = '[abbr]';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::MANUEL, 'Vérifier qne le texte ne
       contiendrait pas d\'abbréviations non définies');
    }
    else {
      foreach($nodes as $node) {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que l\'utilisateur
        a accès une version non abrégée du texte');
      }
    }
  }
}