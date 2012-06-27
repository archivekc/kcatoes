<?php
namespace Kcatoes\rgaa;

class PertinenceEtiquettesForm extends \ASource
{

  const testName = 'Pertinence des étiquettes d\'élément de formulaire';
  const testId = '3.12';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si un segment de texte récupérable dans une des situations suivantes :'
    ,array(
       'contenu dans l\'élément label'
      ,'contenu dans un attribut title sur l\'élément label'
    )
    ,'donne la fonction exacte de l\'élément de formulaire auquel il se rapporte,
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G82'  => 'http://www.w3.org/TR/WCAG20-TECHS/G82'
    ,'G131' => 'http://www.w3.org/TR/WCAG20-TECHS/G131'
    ,'H44'  => 'http://www.w3.org/TR/WCAG20-TECHS/H44'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Formulaires'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements  = 'label';

    $nodes = $crawler->filter($elements);

    $nbNode = 0;
    foreach ($nodes as $node)
    {
      $title = $node->getAttribute('title');
      $nodeValue = $node->nodeValue;
      if (strlen(trim($nodeValue)) > 0){
        $nbNode++;
        $this->addResult($node, \Resultat::MANUEL, 'Le texte est-il pertinent ? : '
        .$nodeValue);
      }elseif (strlen(trim($title)) > 0){
      	$nbNode++;
        $this->addResult($node, \Resultat::MANUEL, 'L\'attribut title est-il
        pertinent ? : '.$title);
      }
    }

    if ($nbNode == 0)
    {
      $this->addResult(null, \Resultat::NA, 'Aucun label non vide dans le document');
    }
  }
}
