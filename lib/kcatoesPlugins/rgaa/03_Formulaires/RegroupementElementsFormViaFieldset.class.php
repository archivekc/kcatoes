<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class RegroupementElementsFormViaFieldset extends \ASource
{
  
  const testName = 'Regroupement d\'éléments de formulaire via l\'élément fieldset';
  const testId = '3.4';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément ne contient pas d\'élément fieldset, poursuivre le test, sinon le 
      test est non applicable.'
    ,'Si les champs contenus dans l\'élément form ne nécessitent pas d\'avoir une 
      information commune ajoutée à chaque label pour un groupe de contrôle donné ou 
      qu\'un groupe ne peut pas être formé de par le type d\'information attendu dans les 
      champs, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
    'H71' => 'http://www.w3.org/TR/WCAG20-TECHS/H71'
  );
  
  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Formulaires'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout élément form.
     */
    $elements = '';

    $nodes = $crawler->filter($elements);
    
    /*
      $this->addResult($node, \Resultat::ECHEC, '');
      $this->addResult($node, \Resultat::REUSSITE, '');
      $this->addResult(null,  \Resultat::NA, '');
      $this->addResult($node, \Resultat::MANUEL, '');
      $this->addResult(null, \Resultat::MANUEL, '');
      
      foreach ($nodes as $node)
      {
      }

      if (count($nodes) == 0)
      {
      }
     */
     $this->addResult(null, \Resultat::NON_EXEC, 'Pas implémenté');
          
  }
}
