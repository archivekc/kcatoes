<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceBasisageGroupesLiensImportants extends \ASource
{

  const testName = 'Présence d\'un balisage permettant d\'identifier les groupes de liens importants';
  const testId = '6.30';
  protected static $testProc = array(
     'Si l\'élément mentionné dans le champ d\'application est présent dans la page, poursuivre le test, sinon le test est non applicable.'
    ,'Si une ancre est définie pour l\'élément par au moins une des techniques suivantes :'
    ,array(
       'la présence d\'un attribut id non vide sur l\'élément lui même'
      ,'la présence d\'un élément a, avec un attribut id ou name non vide, étant l\'élément frère précédent le plus proche de l\'élément'
      ,'la présence d\'un élément a, avec un attribut id ou name non vide, étant le premier enfant de l\'élément'
    )
    ,'le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'H50'  => 'http://www.w3.org/TR/WCAG20-TECHS/H50'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Navigation'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Graphiste', 'Ergonome')
  );

  public function execute()
  {
    /*
      Champ d'application

      Tout élément HTML contenant un groupe de liens importants (zone de navigation, zone de contenu global ou partie de contenu, zone d'outils, etc).
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

     $this->addResult(null, \Resultat::MANUEL, 'Pas implémenté');

  }
}
