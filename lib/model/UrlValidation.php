<?php
/**
 * Librarie de validation d'URL
 *
 * @author Adrien Couet
 */

class UrlValidation
{
  /**
   * Vérifie la validité d'une URL à partir des tests présents dans la classe
   *
   * @param $url URL à tester
   */
	public static function isValide($url)
	{
		$valide = true;
		$valide = $valide && self::isSyntaxeValide($url);
		$valide = $valide && self::isDnsValide($url);

		return $valide;
	}

	/**
	 * Vérifie si la syntaxe d'une URL est correcte
	 *
	 * @param $url URL à tester
	 */
  public static function isSyntaxeValide($url)
  {
  	if(preg_match('#^http://([a-zA-Z0-9-]+.)?([a-zA-Z0-9-]+.)?[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}(:[0-9]+)?(/[a-zA-Z0-9-]*)?(.[a-zA-Z0-9]{1,4})?#', $url))
  	{
  		return true;
  	}
  	else
  	{
      //sfContext::getInstance()->getLogger()->err('L\'URL indiquee ne respecte pas la convention d\'ecriture.');
  		return false;
  	}
  }

  public static function isDnsValide($url)
  {
  	//echo parse_url($url, PHP_URL_HOST);
  	$socket = @fsockopen(parse_url($url, PHP_URL_HOST), 80, $errno, $errstr, 30);
    if(!$socket)
    {
    	//sfContext::getInstance()->getLogger()->err('Echec lors de la connexion au serveur.');
    	return false;
    }
    else
    {
    	fclose($socket);
    	return true;
    }
  }
}