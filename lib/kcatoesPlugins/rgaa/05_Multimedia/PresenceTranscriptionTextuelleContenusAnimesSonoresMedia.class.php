<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceTranscriptionTextuelleContenusAnimesSonoresMedia extends \ASource
{
  
  const testName = 'Présence de la transcription textuelle des contenus visuels animés, sonores ou des médias synchronisés';
  const testId = '5.2';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément permet de télécharger ou de consulter un contenu visuel animé, sonore ou 
      un média synchronisé porteur d\'informations, poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu visuel animé, sonore ou le média synchronisé n\'est pas une alternative 
      animée, sonore ou synchronisée à un contenu textuel présent dans la page, qui est identifiée 
      en tant que tel et qui n\'apporte pas plus d\'information que le contenu textuel, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu visuel animé ou le média synchronisé n\'a pas déjà une description audio 
      synchronisée restituant l\'ensemble des informations, poursuivre le test, sinon le test 
      est non applicable.'
    ,'Si une transcription textuelle du contenu visuel animé, sonore ou du média synchronisé 
      est présente dans la page ou téléchargeable depuis la page, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G58'  => 'http://www.w3.org/TR/WCAG20-TECHS/G58' 
    ,'G69'  => 'http://www.w3.org/TR/WCAG20-TECHS/G69'
    ,'G158' => 'http://www.w3.org/TR/WCAG20-TECHS/G158'
    ,'G159' => 'http://www.w3.org/TR/WCAG20-TECHS/G159'
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
      
          a
          area
          applet
          object
          embed
          tout code javascript générant un des éléments précédents ou déclenchant un téléchargement
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
