<?php
class ExtractHelper {

  public function __construct()
  {
    throw new KcatoesException('La classe ExtractHelper n\'est pas prévue pour être instanciée');
  }
  
  /**
   * NO JS
   */
  static public function removeJS($src)
  {
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
  	
    $doc = new DOMDocument();
    @$doc->loadHTML($src);
    
    $nodes = $doc->getElementsByTagName('*');
  	
  	foreach ($nodes as $node)
    {
    	foreach ($eventHandlers as $eventHandler)
    	{
    		$node->removeAttribute($eventHandler);
    	}
    }

  	return $doc->saveHTML();
  }
}