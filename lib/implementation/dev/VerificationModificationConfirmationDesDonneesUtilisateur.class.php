<?php

/**
 * Ce test regroupe les formulaires présent dans la page pour qu'un testeur
 * puisse vérifier que si un formulaire permet la saisie de données alors
 * l'utilisateur dispose d'au moins une des possibilités suivantes:
 *  - Modifier ou annuler les données ou actions après leur saisie
 *  - Vérifier et corriger les données avant validation définitive
 *  - Répondre à une demande explicite de confirmation avant validation (étape
 *    ou champ supplémentaire)
 *  - Récupération des données quand il s'agit d'une action de suppression (sauf
 *    demande explicite de confirmation avant validation)
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class VerificationModificationConfirmationDesDonneesUtilisateur extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $forms = $page->crawler->filter('form');
    foreach ($forms as $form)
    {
      $this->complements[] = new Complement(
        $this->getSourceCode($form),
        $this->getXPath($form),
        'Si ce formulaire permet de saisir des données , vérifier si '.
        'l\'utilisateur a au moins une des possibilités suivantes: modifier ou'.
        ' annuler les données ou actions après leur saisie, vérifier et corriger'.
        ' les données avant validation définitive, répondre à une demande '.
        'explicite de confirmation avant validation (étape ou champ '.
        'supplémentaire), récupérer les données quand il s\'agit d\'une action'.
        ' de suppression (sauf demande explicite de confirmation avant validation)'
      );
      $reussite = false;
    }
    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}