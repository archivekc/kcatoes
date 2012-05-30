<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDescriptionAudioContenusAnimesMedia extends \ASource
{
  
  const testName = 'Présence d\'une description audio synchronisée pour les contenus visuels animés ou les médias synchronisés';
  const testId = '5.8';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent ou utilisé dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément permet de télécharger ou de restituer un contenu visuel animé ou média synchronisé 
      qui apporte de l\'information, poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu visuel animé ou le média synchronisé n\'est pas une alternative animée ou synchronisée 
      à un contenu textuel présent dans la page, qui est identifiée en tant que tel et qui n\'apporte pas 
      plus d\'information que le contenu textuel, poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu de l\'élément nécessite l\'utilisation d\'une description audio synchronisée pour le 
      rendre compréhensible, poursuivre le test, sinon le test est non applicable.'
    ,'Si au moins une version de l\'élément mis à disposition utilise une description audio synchronisée, 
      le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G78'  => 'http://www.w3.org/TR/WCAG20-TECHS/G78' 
    ,'G173' => 'http://www.w3.org/TR/WCAG20-TECHS/G173'
    ,'SM6'  => 'http://www.w3.org/TR/WCAG20-TECHS/SM6'
    ,'SM7'  => 'http://www.w3.org/TR/WCAG20-TECHS/SM7'
    ,'F74'  => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F74'
  );

  protected static $testGroups = array(
     'niveau'     => 'AA'
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
          tout code javascipt générant un des éléments précédents ou déclenchant un téléchargement
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
