<?php

/**
 * Ce test regroupe les champs de formulaires permettant d'entrer des données
 * textuelles pour qu'un testeur puisse vérifier que si un champ permet de
 * saisir des données alors l'utilisateur a la possibilité d'obtenir une aide
 * contextuelle propre à ce champ par au moins un des moyens suivants:
 *  - Présence d'une page d'aide
 *  - Présence d'un assistant de saisie
 *  - Présence d'un correcteur orthographique ou de suggestions lors de la saisie
 *  - Présence si nécessaire d'informations ou d'exemples sur les formats ou les
 *    types de saisie requise
 *  - Présence d'indication en début de formulaire et utilisation d'un marqueur
 *    distinctif avant chaque élément
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class AideALaSaisieDesFormulaire extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $inputFields = $page->crawler->filter('input[type=text], textarea');
    foreach ($inputFields as $inputField)
    {
      $this->complements[] = new Complement(
        $this->getSourceCode($inputField),
        $this->getXPath($inputField),
        'Si ce champ permet de saisir des données, vérifier si l\'utilisateur '.
        'a bien la possibilité d\'obtenir une aide contextuelle propre à ce '.
        'champ par au moins un des moyens suivants: présence d\'une page d\'aide'.
        ', présence d\'un assistant de saisie, présence d\'un correcteur '.
        'orthographique ou de suggestions lors de la saisie, présence si nécessaire'.
        ' d\'informations ou d\'exemples sur les formats ou les types de saisie'.
        ' requise, présence d\'indication en début de formulaire et utilisation'.
        ' d\'un marqueur distinctif avant chaque élément.'
      );
      $reussite = false;
    }
    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}