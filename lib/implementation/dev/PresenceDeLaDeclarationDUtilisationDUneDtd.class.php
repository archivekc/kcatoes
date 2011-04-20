<?php

/**
 * Vérifie la présence d'une déclaration de !DOCTYPE
 *
 * @author Adrien Couet
 *
 */
class PresenceDeLaDeclarationDUtilisationDUneDtd extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $url = $page->url;
    $lines = file($url);
    $i = 0;
    $foundDoctype = false;

    while ($i < count($lines) && !$foundDoctype)
    {
      if (preg_match('#<!DOCTYPE.*#', $lines[$i]))
      {
        $doctype = preg_replace('#\s#', ' ', $lines[$i]);
        $foundDoctype = true;
      }
      $i++;
    }

    if (!$foundDoctype)
    {
      $this->complements[] = new Complement('', '', 'Aucune déclaration de DOCTYPE n\'est présente dans la page');
      $reussite = false;
    }
    return $reussite ? Resultat::REUSSITE : Resultat::ECHEC;
  }
}