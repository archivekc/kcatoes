<?php

/**
 * Classe dont devra hériter le code de chaque test automatisable
 *
 * @package Kcatoes
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
use Symfony\Component\DomCrawler\Crawler;
abstract class ASource
{
  protected $echecs = array();

  /**
   * Renvoi la liste des objets Echec correspondants aux élément de la page
   * ayant échoué à passer le test
   *
   */
  public function getEchecs()
  {
    return $this->echecs;
  }

  protected  function getXPath(DOMNode $node)
  {
    $q     = new DOMXPath($node->ownerDocument);
    $xpath = '';

    do
    {
      $position = 1 + $q->query('preceding-sibling::*[name()="' . $node->nodeName . '"]', $node)->length;
      $xpath    = '/' . $node->nodeName . '[position()=' . $position . ']' . $xpath;
      $node     = $node->parentNode;
    }
    while (!$node instanceof DOMDocument);

    return $xpath;
  }

  protected function getSourceCode(DOMNode $node)
  {
    $temp_doc  = new DOMDocument('1.0', 'UTF-8');
    $temp_node = $temp_doc->importNode($node, true);
    $temp_doc->appendChild($temp_node);
    return $temp_doc->saveHTML();
  }

  /**
   * Exécute le test implémenté sur une page web
   *
   * @param Page $page La page sur à tester
   */
  abstract public function execute(Page $page);
}
