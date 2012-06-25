<?php
namespace Kcatoes\rgaa;

class RegroupementElementsFormViaFieldset extends \ASource
{

  const testName = 'Regroupement d\'éléments de formulaire via l\'élément fieldset';
  const testId = '3.4';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément ne contient pas d\'élément fieldset, poursuivre le test, sinon le
      test est non applicable.'
    ,'Si les champs contenus dans l\'élément form ne nécessitent pas d\'avoir une
      information commune ajoutée à chaque label pour un groupe de contrôle donné ou
      qu\'un groupe ne peut pas être formé de par le type d\'information attendu dans les
      champs, le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
    'H71' => 'http://www.w3.org/TR/WCAG20-TECHS/H71'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Formulaires'
    ,'profils'    => array('Développeur', 'Intégrateur')
  );

  public function execute()
  {
    $crawler = $this->page->crawler;

    $elements = 'form';

    $nodes = $crawler->filter($elements);

    if (count($nodes) == 0) {
       $this->addResult(null, \Resultat::NA, 'Il n\'y a pas de formulaire');
    }
    else {
      foreach($nodes as $node){
        $bFound = $this->FindFieldset($node);
        if($bFound){
          $this->addResult($node, \Resultat::NA, 'Fieldset présent, test non
          applicable');
        }else{
        	$this->addResult($node, \Resultat::MANUEL, 'Vérifier que le formulaire
          ne nécessite pas que certains champs soient regroupés.');
        }
      }
    }
  }

  private function FindFieldset($node)
  {
    $bFound = false;
    $nodeName = strtolower($node->nodeName);
    //Est-ce le node que nous cherchons ?
    if($nodeName == 'fieldset'){
      return true;
    }

    if($nodeName == 'form' ){
        //Sinon on prospecte chez ses enfants...
        if($node->firstChild != null){
          $bFound = $this->FindFieldset($node->firstChild);
          if($bFound){
            return true;
          }
        }
    }else{
      //...mais aussi chez ses frères
      if($node->nextSibling != null){
        $bFound = $this->FindFieldset($node->nextSibling);
        if($bFound){
          return true;
        }
      }
    }
    return $bFound;
  }
}
