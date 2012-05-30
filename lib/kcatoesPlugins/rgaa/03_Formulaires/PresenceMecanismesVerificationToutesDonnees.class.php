<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceMecanismesVerificationToutesDonnees extends \ASource
{
  
  const testName = 'Présence de mécanismes permettant de vérifier, modifier ou confirmer tous types de données saisie par l\'utilisateur';
  const testId = '3.15';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément permet de saisir des données, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'utilisateur a au moins une des possibilités suivantes :
        modifier ou annuler les données ou actions après leur saisie
        vérifier et corriger les données avant validation définitive
        répondre à une demande explicite de confirmation avant validation (étape supplémentaire ou champ supplémentaire)
        récupérer les données quand il s\'agit d\'une action de suppression (sauf demande explicite de confirmation avant validation)      
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G98'  => 'http://www.w3.org/TR/WCAG20-TECHS/G98'
    ,'G99'  => 'http://www.w3.org/TR/WCAG20-TECHS/G99'
    ,'G155' => 'http://www.w3.org/TR/WCAG20-TECHS/G155'
    ,'G164' => 'http://www.w3.org/TR/WCAG20-TECHS/G164'
    ,'G168' => 'http://www.w3.org/TR/WCAG20-TECHS/G168'
  );
  
  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Formulaires'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );
  
  public function execute()
  {

    /*
      Champ d'application
      
      Tout élément form.
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
