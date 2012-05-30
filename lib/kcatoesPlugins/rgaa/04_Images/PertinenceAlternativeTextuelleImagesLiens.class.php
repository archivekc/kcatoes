<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PertinenceAlternativeTextuelleImagesLiens extends \ASource
{
  
  const testName = 'Pertinence de l\'alternative textuelle aux images liens';
  const testId = '4.2';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément est contenu dans un élément a ou button, poursuivre le test, 
      sinon le test est non applicable.'
    ,'Si l\'élément n\'est pas utilisé comme captcha ou ne fait pas partie d\'un test 
      qui deviendrait inutile si l\'alternative textuelle était présente, poursuivre 
      le test, sinon le test est non applicable, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément possède un attribut alt, poursuivre le test, sinon le test 
      est non applicable.'
    ,'Si le contenu de l\'attribut alt seul ou associé au contenu textuel qui 
      précède ou suit immédiatement l\'élément img (dans l\'élément a) permet d\'identifier 
      la destination du lien ou l\'action déclenchée, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
  );
  
  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Images'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );
  
  public function execute()
  {

    /*
      Champ d'application
      
      Tout élément img ou tout code javascript générant un élément img.
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
