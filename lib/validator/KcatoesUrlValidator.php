<?php

/**
 * Librarie de validation d'URL
 *
 * @package Kcatoes
 * @author Cyril FABBY
 */
class KcatoesUrlValidator extends sfValidatorBase
{
  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
  	if(!filter_var($value, FILTER_VALIDATE_URL)) {
        $value = "http://".$value;
        if(!filter_var($value, FILTER_VALIDATE_URL)) {
          throw new sfValidatorError($this, 'invalid');
        }
      }

    return $value;
  }
}