<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AccessibiliteDesContenusDynamiquesEnJavascript extends \ASource
{
  const testName = 'Accessibilité des contenus dynamiques en javascript';
  const testId = '8.13';
  protected static $testProc = array(
    'Si du code javascript est utilisé dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si le code javascript génère ou met à jour un contenu dans la page avec ou sans action de l’utilisateur,
    poursuivre le test, sinon le test est non applicable.',
    'Si le code généré ou mis à jour comporte tous les attributs et éléments le rendant accessible
     notamment par l’utilisation des fonctions DOM lorsque cela est possible, le test est validé,
     sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  'SCR21' => 'http://www.w3.org/TR/WCAG20-TECHS/SCR21'
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
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier que le code généré
        ou mis à jour comporte tous les attributs et éléments le rendant
        accessible notamment par l’utilisation des fonctions DOM lorsque cela
        est possible');
    }
  }
}