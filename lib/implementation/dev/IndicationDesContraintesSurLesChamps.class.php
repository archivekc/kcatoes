<?php

/**
 * Ce test regroupe les champs de saisie présent dans la page pour permettre à
 * un testeur de vérifier que ceux soumis à un contrôle de saisie avant traitement
 * sont identifiables par un utilisateur et, si nécessaire, que le format ou
 * le type de saisie recquis est indiqué.
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class IndicationDesContraintesSurLesChamps extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $champs = $page->crawler->filter('input[type=text], input[type=password],
                                      input[type=file], input[type=radio],
                                      input[type=checkbox], textarea, select');
    foreach ($champs as $champ)
    {
      $reussite = false;
      $this->complements[] = new Complement(
        $this->getSourceCode($champ),
        $this->getXPath($champ),
        'Si ce champ est soumis à un contrôle de saisie avant traitement, '.
        'vérifier que l\'utilisateur est averti de son caractère obligatoire '.
        'et si nécessaire du format ou du type de saisie recquis'
      );
    }
    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}