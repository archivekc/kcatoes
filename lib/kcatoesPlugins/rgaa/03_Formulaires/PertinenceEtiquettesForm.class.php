<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

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

    /*
      Champ d\'application
      
      Tout élément label.
     */
    
    /*
      $crawler = $this->page->crawler;
      $elements = '';
      $nodes = $crawler->filter($elements);

      $this->addResult($node, \Resultat::ECHEC, '');
      $this->addResult($node, \Resultat::REUSSITE, '');
      $this->addResult(null,  \Resultat::NA, '');
      $this->addResult($node, \Resultat::MANUEL, '');
      
     */
      
     $this->addResult(null, \Resultat::NON_EXEC, 'Pas implémenté');
          
  }
}
