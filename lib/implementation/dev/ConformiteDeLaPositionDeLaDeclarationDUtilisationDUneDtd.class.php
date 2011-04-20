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
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $url = $page->url;
    $lines = file($url);
    $i = 0;
    $foundDoctype = false;
    $foundHtml = false;

    while ($i < count($lines) && !($foundDoctype && $foundHtml ))
    {
      if (preg_match('#<!DOCTYPE.*#', $lines[$i]))
      {
        $doctype = trim($lines[$i]);
        $doctypePos = $i;
        $foundDoctype = true;
      }
      if (preg_match('#<html.*#', $lines[$i]))
      {
        $htmlPos = $i;
        $foundHtml = true;
      }
      $i++;
    }

    if (!$foundDoctype)
    {
      throw new KcatoesTestException('Aucune déclaration de DOCTYPE n\'est présente dans la page');
    }
    elseif (!$foundHtml)
    {
      throw new KcatoesTestException('Aucune balise html n\'est présente dans la page');
    }

    if ($doctypePos > $htmlPos)
    {
      $reussite = false;
      $this->complements[] = new Complement(
        $doctype,
        '',
        'La balise html est située avant la déclaration de DOCTYPE'
      );
    }

    return $reussite ? Resultat::REUSSITE : Resultat::ECHEC;
  }
}