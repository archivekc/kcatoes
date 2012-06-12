<?php
namespace Kcatoes\rgaa;

// FIXME : test à implémenter

class PresenceDescriptionAudioEtendueContenusAnimesMedia extends \ASource
{

  const testName = 'Présence d\'une description audio synchronisée étendue pour les contenus visuels animés ou les médias synchronisés';
  const testId = '5.7';
  protected static $testProc = array(
     'Si l\'un des éléments mentionnés dans le champ d\'application est présent ou utilisé dans la page,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si l\'élément permet de télécharger ou de restituer un contenu visuel animé ou un média synchronisé
      qui apporte de l\'information, poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu visuel animé ou le média synchronisé n\'est pas une alternative animée ou synchronisée
      à un contenu textuel présent dans la page, qui est identifiée en tant que tel et qui n\'apporte pas plus
      d\'information que le contenu textuel, poursuivre le test, sinon le test est non applicable.'
    ,'Si le contenu de l\'élément nécessite l\'utilisation d\'une description audio pour le rendre compréhensible,
      poursuivre le test, sinon le test est non applicable.'
    ,'Si la durée des pauses dans la piste sonore du contenu visuel animé ou du média synchronisé ne permet
      pas de restituer l\'ensemble des informations nécessaire à la compréhension de l\'élément, poursuivre le test,
      sinon le test est non applicable'
    ,'Si au moins une version de l\'élément mis à disposition utilise une description audio étendue, le test
      est validé, sinon le test est invalidé.'
  );
  protected static $testDocLinks = array(
     'G8'  => 'http://www.w3.org/TR/WCAG20-TECHS/G8'
    ,'SM1' => 'http://www.w3.org/TR/WCAG20-TECHS/SM1'
    ,'SM2' => 'http://www.w3.org/TR/WCAG20-TECHS/SM2'
    ,'F74' => 'http://www.w3.org/TR/2010/NOTE-WCAG20-TECHS-20101014/F74'
  );

  protected static $testGroups = array(
     'niveau'     => 'AAA'
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

     $this->addResult(null, \Resultat::MANUEL, 'Pas implémenté');

  }
}
