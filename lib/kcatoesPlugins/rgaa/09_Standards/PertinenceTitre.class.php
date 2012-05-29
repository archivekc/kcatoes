<?php
namespace Kcatoes\rgaa;



class PertinenceTitre extends \ASource
{
  
  const testName = 'Pertinence du titre de la page';
  const testId = '9.7';
  protected static $testProc = array(
    'Si l\'élément mentionné dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.', 
    'Si le contenu de l\'élément permet d\'identifier clairement le contenu et la fonction de la page, le test est validé, sinon le test est invalidé.' 
  );
  protected static $testDocLinks = array(
    'G88' => 'http://www.w3.org/TR/WCAG20-TECHS/G88.html',
    'H25' => 'http://www.w3.org/TR/WCAG20-TECHS/H25.html', 
    'F25' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F25.html'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Standards'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );
  
  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements   = 'title';

    $nodes = $crawler->filter($elements);

    if (count($nodes) > 0) {
      $nodes->rewind();
      $title = $nodes->current();
      $val = trim($title->nodeValue);
      
      if (strlen($val) > 0) {
        $this->addResult($title, \Resultat::MANUEL, 'L\'élément title est-il pertinent ? : ' . $val);
        return;
      }
    }
    
    $this->addResult(null, \Resultat::NA, 'Pas d\'élément title dans la page ou celui-ci est vide');
  }
}
