<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PertinenceDescriptionAudioContenusAnimesMedia extends \ASource
{
  
  const testName = 'Pertinence de la description audio synchronisée des contenus visuels animés ou des médias synchronisés';
  const testId = '5.5';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément apporte suffisamment d\'informations pour comprendre 
      le contenu de l\'élément visuel animé ou du média synchronisé (textes 
      apparaissant à l\'écran, actions visuelles, attitudes, émotions visiblement 
      évidentes, gestes, changements de scène, etc), le test est validé, 
      sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     '' => 'http://www.w3.org/TR/WCAG20-TECHS/G8' 
    ,'' => 'http://www.w3.org/TR/WCAG20-TECHS/G78'
    ,'' => 'http://www.w3.org/TR/WCAG20-TECHS/G166'
    ,'' => 'http://www.w3.org/TR/WCAG20-TECHS/G173'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d'application
      
      Tout contenu sonore constituant une description audio d'un contenu visuel animé ou d'un média synchronisé.
     */
    $elements   = '';

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
