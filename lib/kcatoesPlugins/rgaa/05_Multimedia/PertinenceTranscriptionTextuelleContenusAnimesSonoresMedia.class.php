<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PertinenceTranscriptionTextuelleContenusAnimesSonoresMedia extends \ASource
{
  
  const testName = 'Pertinence de la transcription textuelle des contenus visuels animés, sonores ou des médias synchronisés';
  const testId = '5.3';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page ou dans un 
      fichier en téléchargement , poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément permet d\'avoir accès au même niveau d\'informations que le contenu visuel animé, 
      sonore ou le média synchronisé, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G69'  => 'http://www.w3.org/TR/WCAG20-TECHS/G69' 
    ,'G158' => 'http://www.w3.org/TR/WCAG20-TECHS/G158'
    ,'G159' => 'http://www.w3.org/TR/WCAG20-TECHS/G159'
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
      
      Tout segment de texte constituant une transcription textuel d'un contenu visuel animé, sonore ou d'un média synchronisé.
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
