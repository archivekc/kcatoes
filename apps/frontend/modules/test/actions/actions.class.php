<?php

/**
 * test actions.
 *
 * @package    kcatoes
 * @subpackage test
 * @author     Adrien Couet
 */
class testActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('test','goutte');
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeGoutte(sfWebRequest $request)
  {
    $this->urlDeTest = 'http://www.keyconsulting.fr/';

    $page = new Page();
    $crawler = $page->request('GET', $this->urlDeTest);
    $nodes = $crawler->filter('div');
    $this->nbDiv = $nodes->count();
  }
}
