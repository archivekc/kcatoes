<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class OrdreAccesAuClavierAuxContenusMisAJourDynamiquementEnJavascript extends \ASource
{
  const testName = 'Ordre d\'accès au clavier aux contenus mis à jour dynamiquement en javascript';
  const testId = '8.6';
  protected static $testProc = array(
    'Si du code javascript est utilisé dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si le code javascript met à jour ou génère un contenu après action de l\'utilisateur,
     poursuivre le test, sinon le test est non applicable.',
    'Si le contenu mis à jour ou généré comporte tous les attributs et éléments le rendant accessible,
     poursuivre le test, sinon le test est non applicable.',
    'Si le contenu mis à jour ou généré (ou un lien vers celui-ci) se situe juste après l\'élément
     ayant permis de déclencher la mise à jour ou la génération du contenu, le test est validé,
     sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'SCR26' => 'http://www.w3.org/TR/WCAG20-TECHS/SCR26'
  , 'SCR27' => 'http://www.w3.org/TR/WCAG20-TECHS/SCR27'
  , 'SCR37' => 'http://www.w3.org/TR/WCAG20-TECHS/SCR37'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Scripts'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'applet';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Test non applicable');
    }
    else {
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que si du contenu
        a été mis à jour ou généré, celui-ci est accessible juste après l\'élément
        ayant permis de déclencher la mise à jour ou la génération de ce dernier');
    }
  }
}