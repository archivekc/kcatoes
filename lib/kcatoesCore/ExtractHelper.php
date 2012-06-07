<?php
class ExtractHelper {

  public function __construct()
  {
    throw new KcatoesException('La classe ExtractHelper n\'est pas prévue pour être instanciée');
  }
  
  /**
   * NO JS
   */
  static public function removeJS($src, $doctype)
  {
  	$isXml = false;
  	
  	$xmlDoctype = array(
  	     '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
        '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">'
  	);
  	
  	if (in_array($doctype, $xmlDoctype))
  	{
  		$isXml = true;
  	}
  	
    $eventHandlers = array(
      'onabort'
      ,'onblur'
      ,'onchange'
      ,'onclick'
      ,'ondblclick'
      ,'ondragdrop'
      ,'onerror'
      ,'onfocus'
      ,'onkeydown'
      ,'onkeypress'
      ,'onkeyup'
      ,'onload'
      ,'onmousedown'
      ,'onmousemove'
      ,'onmouseout'
      ,'onmouseover'
      ,'onmouseup'
      ,'onmove'
      ,'onreset'
      ,'onresize'
      ,'onselect'
      ,'onsubmit'
      ,'onunload'
    );

    /* suppression des balises scripts */
    $src = preg_replace('%<script.*/script>%ui', '', $src);
    foreach ($eventHandlers as $eventHandler)
    {
      $src = preg_replace('%(<[^>]*)'.$eventHandler.'(=[^>]*>)%Ui', "$1".'_'.$eventHandler.'_'."$2", $src);
    }
    return $src;
  }
}