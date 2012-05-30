<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceAlternativeAppletObject extends \ASource
{
  
  const testName = 'Présence d\'une alternative aux éléments applet et object';
  const testId = '5.11';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément apporte de l\'information, poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu visuel animé, sonore ou le média synchronisé n\'est pas une alternative animée, 
      sonore ou synchronisée à un contenu textuel présent dans la page, qui est identifiée en tant 
      que tel et qui n\'apporte pas plus d\'information que le contenu textuel, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si le contenu n\'est pas consulté dans un environnement informatique maitrisé permettant la 
      restitution des contenus affichés au travers des éléments object ou applet, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si une alternative à l\'élément est disponible dans un des cas suivants :
        entre la balise ouvrante et la balise fermante de l\'élément
        dans le contenu de l\'attribut alt pour l\'élément applet
        en dehors de l\'élément, par le biais d\'un élément a , area ou directement dans le contenu de la page
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G58'  => 'http://www.w3.org/TR/WCAG20-TECHS/G58'
    ,'G69'  => 'http://www.w3.org/TR/WCAG20-TECHS/G69'
    ,'G158' => 'http://www.w3.org/TR/WCAG20-TECHS/G158'
    ,'G159' => 'http://www.w3.org/TR/WCAG20-TECHS/G159'
    ,'H27'  => 'http://www.w3.org/TR/WCAG20-TECHS/H27'
    ,'H35'  => 'http://www.w3.org/TR/WCAG20-TECHS/H35'
    ,'H53'  => 'http://www.w3.org/TR/WCAG20-TECHS/H53'
    ,'F19'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F19'
    ,'F74'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F74'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {
    /*
      Champ d'application
      
      Tout élément :
      
          applet
          object
          tout code javascript générant un des éléments précédents
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
