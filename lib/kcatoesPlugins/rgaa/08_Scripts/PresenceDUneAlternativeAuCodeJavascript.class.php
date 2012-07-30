<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDUneAlternativeAuCodeJavascript extends \ASource
{
  const testName = 'Présence d\'une alternative au code javascript';
  const testId = '8.12';
  protected static $testProc = array(
    'Si du code javascript est utilisé dans la page, poursuivre le test, sinon le test est non applicable.',
    'Si le code javascript est nécessaire pour accéder à des informations, poursuivre le test,
     sinon le test est non applicable.',
    'Si le contenu mis à disposition grâce au javascript ne permet pas d\'avoir accès
     au même niveau d\'information qu\'un contenu textuel présent dans la page, poursuivre le test,
     sinon le test est non applicable.',
    'Si le contenu n\'est pas consulté dans un environnement informatique maitrisé
     dans lequel javascript est obligatoirement activé, poursuivre le test, sinon le test est non applicable.',
    'Si une alternative au code javascript est présente dans au moins un des cas suivants :
     dans une balise noscript, par l\'utilisation de code javascript non obstrusif permettant d\'avoir accès
     à l\'alternative par le biais d\'un élément a, area ou directement dans le contenu de la page
     lorsque javascript est désactivé, par l\'utilisation d\'un langage de script côté serveur
     le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
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
        $this->addResult($node, \Resultat::MANUEL, 'Vérifier qu\'il y a une
        alternative au code javascript si il permet d\'accéder des informations');
    }
  }
}