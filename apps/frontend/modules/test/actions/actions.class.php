<?php

/**
 * test actions.
 *
 * @package    kcatoes
 * @subpackage test
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
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
    $this->urlDeTest = 'http://www.keyconsulting.fr';

    require_once sfConfig::get('sf_lib_dir').'/vendor/goutte/goutte.phar';

    $client = new Goutte\Client();
    $this->crawler = $client->request('GET', $this->urlDeTest);

  }
}