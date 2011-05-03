<?php

/**
 * Librarie de validation d'URL
 *
 * @package Kcatoes
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
class KcatoesUrlValidator extends sfValidatorBase
{
  /**
   * Configures the current validator.
   *
   * @param array $options   An array of options
   * @param array $messages  An array of error messages
   *
   * @see sfValidatorBase
   */
  protected function configure($options = array(), $messages = array())
  {
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
    $clean = (string) $value;

    try
    {
      self::isValide($value);
    }
    catch (KcatoesUrlException $e)
    {
      $errorMessage = $e->getMessage();
      sfContext::getInstance()->getLogger()->err($errorMessage);
      $this->setMessage('invalid', $errorMessage);
      throw new sfValidatorError($this, 'invalid');
    }

    return $clean;
  }

  /**
   * Vérifie la validité d'une URL à partir des tests présents dans la classe
   *
   * @param String $url URL à tester
   * @throws KcatoesUrlException
   *
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
   * @param String $url URL à tester
   * @throws KcatoesUrlException
   * @tested
   */
  public static function isSyntaxeValide($url)
  {
    if (!preg_match("((https?|ftp|gopher|telnet|file|notes|ms-help):((//)|(\\\\))+[\w\d:#@%/;$()~_?\+-=\\\.&]*)", $url))
    {
      throw new KcatoesUrlException('L\'URL indiquée ne respecte pas la convention d\'écriture.');
    }
  }

  /**
   * Vérifie si le serveur pointé par une URL est accessible depuis
   * l'application en essayant de s'y connecter puis récupère les méta
   * données de la page indiquée par l'URL
   *
   * @param String $url URL à tester
   * @throws KcatoesUrlException
   * @return Un tableau contenant les métas données de la page
   *
   * @tested
   */
  public static function isDnsValide($url)
  {
    $page = @fopen($url, 'r');
    if (!$page)
    {
      throw new KcatoesUrlException('Echec lors de la connexion au serveur.');
    }
    else
    {
      $meta = stream_get_meta_data($page);
      fclose($page);
      return $meta;
    }
  }


  /**
   * Vérifie que le serveur renvoit bien un code HTTP 200 lors de l'accès
   * à la page désignée par une URL
   *
   * @param $meta Meta données de l'URL à tester
   * @throws KcatoesUrlException
   *
   * @tested
   */
  public static function isCodeHttpValide($meta)
  {

    $return = explode(' ', $meta['wrapper_data'][0]);
    if ($return[1] != 200)
    {
      throw new KcatoesUrlException('Le serveur a renvoyé un code HTTP non valide: '.$return[1]);
    }
  }

  /**
   * Vérifie que la page pointée par une URL est bien au format
   *
   * @param $meta Meta données de l'URL à tester
   * @throws KcatoesUrlException
   *
   * @tested
   */
  public static function isFormatValide($meta)
  {
    $found = false;
    $i = 0;
    while (!$found && $i < count($meta['wrapper_data']))
    {
      $return = explode(' ', $meta['wrapper_data'][$i]);
      $found = $return[0] == 'Content-Type:';
      $i++;
    }
    if (!preg_match('#text/html#', $return[1]) && !preg_match('#text/xml#', $return[1]))
    {
      throw new KcatoesUrlException('La page récuperée n\'est pas au format XHTML.');
    }
  }
}