<?php
namespace Kcatoes\rgaa;

class PresencePageAideOuMecanismeContextuel extends \ASource
{

  const testName = 'Présence d\'une page d\'aide ou d\'un mécanisme d\'aide contextuelle pour la saisie des formulaires';
  const testId = '3.16';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément permet de saisir des données, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'utilisateur à la possibilité d\'obtenir une aide contextuelle propre à chacun des champs de
      saisie par au moins un des mécanismes suivant :'
    ,array('présence d\'une page d\'aide'
          ,'présence d\'un assistant de saisie'
          ,'présence d\'un correcteur orthographique ou de suggestions lors de la saisie'
          ,'présence si nécessaire d\'informations ou d\'exemples sur les formats ou les types de saisie requise.'
          ,'présence d\'indication en début de formulaire et utilisation d\'un marqueur distinctif avant chaque élément')
    ,'le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G71'  => 'http://www.w3.org/TR/WCAG20-TECHS/G71'
    ,'G89'  => 'http://www.w3.org/TR/WCAG20-TECHS/G89'
    ,'G184' => 'http://www.w3.org/TR/WCAG20-TECHS/G184'
    ,'G193' => 'http://www.w3.org/TR/WCAG20-TECHS/G193'
    ,'G194' => 'http://www.w3.org/TR/WCAG20-TECHS/G194'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Formulaires'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements  = 'input[type=text], textarea';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Il n\'y a pas les éléments recherchés ');
    }
    else {
      foreach ($nodes as $node)
      {
        $this->addResult($node, \Resultat::MANUEL, 'Y a-t-il une page d\'aide ou
        un mécanisme d’aide contextuelle lié à cet élément?');
      }
    }
  }
}
