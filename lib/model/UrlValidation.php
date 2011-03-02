<?php
/**
 * Librarie de validation d'URL
 *
 * @author Adrien Couet
 */

use Zend\Validator\File\Count;
use Zend\Db\Select;
class UrlValidation
{

  /**
   * Vérifie la validité d'une URL à partir des tests présents dans la classe
   *
   * @param $url URL à tester
   * @tested
   */
  public static function isValide($url)
  {
    self::isSyntaxeValide($url);
    $meta = self::isDnsValide($url);
    self::isCodeHttpValide($meta);
    self::isFormatValide($meta);
  }

  /**
   * Vérifie si la syntaxe d'une URL est correcte
   *
   * @param $url URL à tester
   * @tested
   */
  public static function isSyntaxeValide($url)
  {
    if(!preg_match('#^http://([a-zA-Z0-9-]+.)?([a-zA-Z0-9-]+.)?[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}(:[0-9]+)?(/[a-zA-Z0-9-]*)?(.[a-zA-Z0-9]{1,4})?#', $url))
    {
      throw new KcatoesUrlException('L\'URL indiquée ne respecte pas la convention d\'écriture.');
    }
  }

  /**
   * Vérifie si le serveur pointé par une URL est accessible depuis
   * l'application en essayant de s'y connecter
   *
   * @param $url URL à tester
   * @tested
   */
  public static function isDnsValide($url)
  {
    $fp = @fopen($url, 'r');
    if(!$fp)
    {
      throw new KcatoesUrlException('Echec lors de la connexion au serveur.');
    }
    else
    {
      $meta = stream_get_meta_data($fp);
      fclose($fp);
      return $meta;
    }
  }


  /**
   * Vérifie que le serveur renvoit bien un code HTTP 200 lors de l'accès
   * à la page désignée par une URL
   *
   * @param $meta Meta données de l'URL à tester
   * @tested
   */
  public static function isCodeHttpValide($meta)
  {

    $return = explode(' ', $meta['wrapper_data'][0]);
    if($return[1] != 200)
    {
      throw new KcatoesUrlException('Le serveur a renvoyé un code HTTP non valide: '.$return[1]);
    }
  }

  /**
   * Vérifie que la page pointée par une URL est bien au format
   *
   * @param $meta Meta données de l'URL à tester
   * @tested
   */
  public static function isFormatValide($meta)
  {
    $found = false;
    $i = 0;
    while(!$found && $i < count($meta['wrapper_data']))
    {
      $return = explode(' ', $meta['wrapper_data'][$i]);
      $found = $return[0] == 'Content-Type:';
      $i++;
    }
    if(!preg_match('#text/html#', $return[1]) && !preg_match('#text/xml#', $return[1]))
    {
      throw new KcatoesUrlException('La page recuperée n\'est pas au format XHTML.');
    }
  }
}