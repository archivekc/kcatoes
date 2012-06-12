<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class AccesInformationSynthetiqueContenusSonoresAnimesMedia extends \ASource
{

  const testName = 'Accès à une information synthétique pour les contenus sonores, visuels animés ou les médias synchronisés';
  const testId = '5.1';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément n\'est pas contenu dans un élément a ou button, poursuivre le test,
      sinon le test est non applicable.'
    ,'Si l\'élément apporte une information, poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément est identifiable par un nom usuel ou fonctionnel, un titre, une description
      synthétique des contenus, du processus ou des actions possibles mis à disposition
      par au moins une des solutions suivantes :'
    ,array(
       'le contenu de l\'attribut alt'
      ,'le contenu alternatif avant la fermeture de l\'élément dans le cas de l\'élément object'
      ,'le contenu alternatif dans l\'élément noembed dans le cas de l\'élément embed'
      ,'le contenu de l\'attribut alt d\'une des images d\'un groupe d\'images formant un tout'
      ,'le contenu textuel qui précède ou suit immédiatement l\'élément'
    )
    ,'le test est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G68'  => 'http://www.w3.org/TR/WCAG20-TECHS/G68'
    ,'G100' => 'http://www.w3.org/TR/WCAG20-TECHS/G100'
  );

  protected static $testGroups = array(
     'niveau'     => 'A'
    ,'thematique' => 'Multimédia'
    ,'profils'    => array('Développeur', 'Intégrateur', 'Rédacteur', 'Contributeur')
  );

  public function execute()
  {
    /*
      Tout élément :

          img au format gif, apng ou mng
          applet
          object
          embed
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

     $this->addResult(null, \Resultat::MANUEL, 'Pas implémenté');

  }
}
