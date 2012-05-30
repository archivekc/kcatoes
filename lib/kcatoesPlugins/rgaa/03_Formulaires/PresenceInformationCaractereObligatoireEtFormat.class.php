<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceInformationCaractereObligatoireEtFormat extends \ASource
{
  
  const testName = 'Présence d\'information préalable sur le caractère obligatoire de certains champs de saisie et du type/format de saisie attendue si nécessaire';
  const testId = '3.2';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
     poursuivre le test, sinon le test est non applicable. Si l\'élément est soumis à un contrôle 
     de saisie avant d\'être traité, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'utilisateur est averti du caractère obligatoire de l\'élément et si nécessaire du 
      format ou du type de saisie requis par au moins un des mécanismes suivant :
        indication en début de formulaire et identification des champs par un marqueur distinctif 
      situé avant chaque élément de formulaire dans l\'ordre du code source (ou après pour input 
      type="checkbox", input type="radio") au sein d\'une balise label associée à l\'élément,
        indication avant chaque élément de formulaire dans l\'ordre du code source (ou après pour 
      input type="checkbox", input type="radio") au sein d\'une balise label associée à l\'élément
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G83'  => 'http://www.w3.org/TR/WCAG20-TECHS/G83'
    ,'G89'  => 'http://www.w3.org/TR/WCAG20-TECHS/G89'
    ,'G184' => 'http://www.w3.org/TR/WCAG20-TECHS/G184'
    ,'H44'  => 'http://www.w3.org/TR/WCAG20-TECHS/H44'
  );
  
  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Formulaires'
    ,'profils'    => array('Graphiste', 'Ergonome')
  );
  
  public function execute()
  {

    /*
      Champ d'application
      
      Tout élément :
      
          input type="text"
          input type="checkbox"
          input type="file"
          input type="radio"
          input type="password"
          select
          textarea
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
