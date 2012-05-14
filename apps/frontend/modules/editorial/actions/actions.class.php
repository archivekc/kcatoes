<?php

/**
 * actions pour les pages éditoriales.
 *
 * @package    kcatoes
 * @subpackage editorial
 * @author     cfabby
 */
class editorialActions extends kcatoesActions
{
	/**
	 * Page d'accueil
	 */
	public function executeHomepage()
	{
		$_SERVER['rubrique'] = 'homepage';
	}
	
  /**
   * Page crédit
   */
  public function executeCredits()
  {
    $_SERVER['rubrique'] = 'credit';
  }
  /**
   * Page aide
   */
  public function executeAide()
  {
    $_SERVER['rubrique'] = 'aide';
  }
}
