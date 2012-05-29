<?php
namespace Kcatoes\rgaa;



class ValeurContrasteTexteAgrandiSegmentTexteAmelioree extends \ASource
{
  
  const testName = 'Valeur du rapport de contraste du texte agrandi contenu dans un segment de texte (améliorée)';
  const testId = '2.16';
  protected static $testProc = array(
     'Si le segment de texte mentionné dans le champ d’application est présent dans la page, 
      poursuivre le test, sinon le test est non applicable.'
    ,'Si le segment de texte apporte de l’information, n’est pas un logo ou un texte faisant 
      parti d’un logo et qu’aucun mécanisme permettant d’afficher l’élément avec un rapport de 
      contraste suffisant n’est présent, poursuivre le test, sinon le test est non applicable.'
    ,'Si la taille finale du texte affichée est supérieure ou égale à 150% ou 120% gras de la taille 
      du texte par défaut spécifiée par les styles de la page, ou, en son absence, de la taille fixée 
      couramment par un navigateur, poursuivre le test, sinon le test est non applicable.'
    ,'Si le rapport de contraste entre la couleur du texte agrandi et celle de son arrière plan est 
      supérieur ou égal à 3, le test est validé, sinon le test est invalidé.');
  protected static $testDocLinks = array(
     'G18'  => 'http://www.w3.org/TR/WCAG20-TECHS/G18'
    ,'G174' => 'http://www.w3.org/TR/WCAG20-TECHS/G174'
  );
  
  protected static $testGroups = array(
     'niveau'     => 'AAA'
    ,'thematique' => 'Couleurs'
    ,'profils'    => array('Graphiste', 'Ergonome')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    /*
      Champ d’application
      
      Tout segment de texte (mot, groupe de mots, phrase, bloc de texte), contenu ou non dans un élément HTML, ou généré via du code javascript ou des feuilles de styles, et mis en couleur par des styles utilisant au moins l’une des propriétés CSS suivantes :
      
          color
          background
          background-color
          background-image
          content
          list
          list-style-image
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
