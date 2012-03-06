<?php

/**
 * Vérifie que la déclaration de DOCTYPE se fait bien avant l'ouverture de la
 * balise HTML
 *
 * @author Adrien Couet
 *
 */
class ConformiteDeLaPositionDeLaDeclarationDUtilisationDUneDtd extends ASource
{
  public function __construct()
  {
    $this->explication = 'La déclaration de DOCTYPE doit précéder l\'ouverture de la balise HTML';
  }

  public function execute(Page $page)
  {
    $url = $page->url;
    $lines = file($url);
    $i = 0;
    $foundDoctype = false;
    $foundHtml = false;

    while ($i < count($lines) && (!$foundDoctype || !$foundHtml ))
    {
      if (preg_match('#<!DOCTYPE.*#', $lines[$i]))
      {
        $doctype = $i;
        $foundDoctype = true;
      }
      if (preg_match('#<html .*#', $lines[$i]))
      {
        $html = $i;
        $foundHtml = true;
      }
      $i++;
    }

    if (!$foundDoctype)
    {
      $this->explication = 'Aucune déclaration de DOCTYPE n\'est présente dans la page';
      return false;
    }
    return ($doctype < $html);
  }
}