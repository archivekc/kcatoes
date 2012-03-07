<?php
/**
 * Vérifie si la page ne contient pas de balise meta provoquant son
 * rafraichissement automatique.
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class RafraichissementAutomatique1 extends ASource
{
  public function __construct()
  {
  }

  public function execute(Page $page)
  {
    $reussite = true;
    $metas = $page->crawler->filter('meta[http-equiv]');

    foreach ($metas as $meta)
    {
      $equiv = $meta->getAttribute('http-equiv');
      if (strtolower($equiv) === 'refresh')
      {
        if ($meta->hasAttribute('content'))
        {
          $content = explode(';', $meta->getAttribute('content'));
          $timer = $content[0];
          if ($timer >= 0 && $timer < 72000)
          {
            if (isset($content[1]))
            {
              $target = trim(preg_replace('#.*url[ ]*=#i', '', $content[1]));
              if ($page->url === $target)
              {
                $reussite = false;
                $this->complements[] = new Complement(
                  $this->getSourceCode($meta),
                  $this->getXPath($meta),
                  'Vérifiez que le rafraichissement de cette page peut être supprimé'.
                  ' sans en supprimer les informations ou les fonctionnalités du contenu'
                );
              }
            }
            else
            {
              $reussite = false;
              $this->complements[] = new Complement(
                $this->getSourceCode($meta),
                $this->getXPath($meta),
                'Vérifiez que le rafraichissement de cette page peut être supprimé'.
                ' sans en supprimer les informations ou les fonctionnalités du contenu'
              );
            }
          }
        }
      }
    }
    return $reussite ? Resultat::REUSSITE : Resultat::MANUEL;
  }
}