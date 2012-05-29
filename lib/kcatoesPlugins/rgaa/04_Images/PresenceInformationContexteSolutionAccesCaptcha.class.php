<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceInformationContexteSolutionAccesCaptcha extends \ASource
{
  
  const testName = 'Présence d\'une information de contexte et d\'une solution d\'accès pour les captcha lorsque l\'alternative ne peut pas être communiquée';
  const testId = '4.10';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément est utilisé comme captcha ou fait partie d\'un test qui deviendrait inutile 
      si l\'alternative textuelle était présente, poursuivre le test, sinon le test est non applicable.'
    ,'Si un nom usuel ou fonctionnel, un titre, une description synthétique des contenus, 
      du processus ou des actions possibles permettant d\'identifier l\'élément est disponible 
      dans la page et qu\'une solution alternative permettant d\'avoir accès à la fonction ou au 
      contenu protégé est présente dans ou depuis la page, le test est validé, sinon le test 
      est invalidé.'
  );
  protected static $testDocLinks = array(
     'G100' => 'http://www.w3.org/TR/WCAG20-TECHS/G100'
    ,'G143' => 'http://www.w3.org/TR/WCAG20-TECHS/G143'
    ,'G144' => 'http://www.w3.org/TR/WCAG20-TECHS/G144'
    ,'F19'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F19'
  );
  
  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Images'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout élément :
      
          img
          applet
          embed
          object
          input type="image"
          tout code javascript générant un des éléments précédents
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
