<?php

/**
 * Récupère la liste des éléments a, abbr, acronym, address, area, bdo,
 * blockquote, button, caption, cite, code, dd, dfn, dir, dl, dt, em, fieldset,
 * form, h1, h2, h3, h4, h5, h6, input, ins, kbd, label, legend, li, menu, ol,
 * pre, q, samp, select, strong, sub, sup, th, var et ul présents dans la page
 * pour permettre à un testeur de vérifier qu'ils ne sont pas utilisé uniquement
 * à des fins de présentation.
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class AbsenceDElementsHtmlUtilisesADesFinsDePresentation extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $elements =
      'a, abbr, acronym, address, area, bdo, blockquote, button, caption, cite, '.
      'code, dd, dfn, dir, dl, dt, em, fieldset, form, h1, h2, h3, h4, h5, h6, '.
      'input, ins, kbd, label, legend, li, menu, ol, pre, q, samp, select, '.
      'strong, sub, sup, th, var, ul';
    $nodes = $page->crawler->filter($elements);

    foreach ($nodes as $node)
    {
      $this->complements[] = new Complement(
        $this->getSourceCode($node),
        $this->getXPath($node),
        'Vérifier que cet élément n\'est pas utilisé uniquement à des fins de '.
        'présentation'
      );
    }
    $reussite = $reussite && (count($nodes) === 0);

    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}