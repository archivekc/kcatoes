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
  
  /**
   * Correction de l'encodage de certains caractères cp1252 et conversion en UTF-8
   * (voir http://fr2.php.net/manual/fr/function.utf8-encode.php)
   * @param string $input
   * @return string
   */
  static public function fix_latin($input)
  {
    // Pas de conversion si déjà en UTF-8
    if(mb_check_encoding($input,'UTF-8'))
    {
      return $input; 
    }
    
    // Initialisation du tableau de substitution
    for($x=128;$x<256;++$x){
      $byte_map[chr($x)] = utf8_encode(chr($x));
    }
    
    $cp1252_map = array(
      "\x80" => "\xE2\x82\xAC",  // EURO SIGN
      "\x82" => "\xE2\x80\x9A",  // SINGLE LOW-9 QUOTATION MARK
      "\x83" => "\xC6\x92",      // LATIN SMALL LETTER F WITH HOOK
      "\x84" => "\xE2\x80\x9E",  // DOUBLE LOW-9 QUOTATION MARK
      "\x85" => "\xE2\x80\xA6",  // HORIZONTAL ELLIPSIS
      "\x86" => "\xE2\x80\xA0",  // DAGGER
      "\x87" => "\xE2\x80\xA1",  // DOUBLE DAGGER
      "\x88" => "\xCB\x86",      // MODIFIER LETTER CIRCUMFLEX ACCENT
      "\x89" => "\xE2\x80\xB0",  // PER MILLE SIGN
      "\x8A" => "\xC5\xA0",      // LATIN CAPITAL LETTER S WITH CARON
      "\x8B" => "\xE2\x80\xB9",  // SINGLE LEFT-POINTING ANGLE QUOTATION MARK
      "\x8C" => "\xC5\x92",      // LATIN CAPITAL LIGATURE OE
      "\x8E" => "\xC5\xBD",      // LATIN CAPITAL LETTER Z WITH CARON
      "\x91" => "\xE2\x80\x98",  // LEFT SINGLE QUOTATION MARK
      "\x92" => "\xE2\x80\x99",  // RIGHT SINGLE QUOTATION MARK
      "\x93" => "\xE2\x80\x9C",  // LEFT DOUBLE QUOTATION MARK
      "\x94" => "\xE2\x80\x9D",  // RIGHT DOUBLE QUOTATION MARK
      "\x95" => "\xE2\x80\xA2",  // BULLET
      "\x96" => "\xE2\x80\x93",  // EN DASH
      "\x97" => "\xE2\x80\x94",  // EM DASH
      "\x98" => "\xCB\x9C",      // SMALL TILDE
      "\x99" => "\xE2\x84\xA2",  // TRADE MARK SIGN
      "\x9A" => "\xC5\xA1",      // LATIN SMALL LETTER S WITH CARON
      "\x9B" => "\xE2\x80\xBA",  // SINGLE RIGHT-POINTING ANGLE QUOTATION MARK
      "\x9C" => "\xC5\x93",      // LATIN SMALL LIGATURE OE
      "\x9E" => "\xC5\xBE",      // LATIN SMALL LETTER Z WITH CARON
      "\x9F" => "\xC5\xB8"       // LATIN CAPITAL LETTER Y WITH DIAERESIS
    );
    
    // Complément du tableau de substitution avec les caractères chiants
    foreach($cp1252_map as $k=>$v){
      $byte_map[$k]=$v;
    }
  
    // Construction de la regexp
    $ascii_char = '[\x00-\x7F]';
    $cont_byte  = '[\x80-\xBF]';
    $utf8_2     = '[\xC0-\xDF]'.$cont_byte;
    $utf8_3     = '[\xE0-\xEF]'.$cont_byte.'{2}';
    $utf8_4     = '[\xF0-\xF7]'.$cont_byte.'{3}';
    $utf8_5     = '[\xF8-\xFB]'.$cont_byte.'{4}';    
    $nibble_good_chars = "@^($ascii_char+|$utf8_2|$utf8_3|$utf8_4|$utf8_5)(.*)$@s";
    
    // Conversion
    $outstr = '';
    $char   = '';
    $rest   = '';
    while((strlen($input))>0){
      if (1 == preg_match($nibble_good_chars, $input, $match))
      {
        $char    = $match[1];
        $rest    = $match[2];
        $outstr .= $char;
      }
      elseif (1 == preg_match('@^(.)(.*)$@s', $input, $match))
      {
        $char    = $match[1];
        $rest    = $match[2];
        $outstr .= $byte_map[$char];
      }
      $input = $rest;
    }
    return $outstr;
  }
  
  
  /**
   * Fonction de conversion en UTF-8
   * (voir http://fr2.php.net/manual/fr/function.utf8-encode.php)
   * @param string $content
   * @return string
   */
  static public function utf8convert($content)
  {
    if( !mb_check_encoding($content, 'UTF-8')
        || !($content === mb_convert_encoding(mb_convert_encoding($content, 'UTF-32', 'UTF-8' ), 'UTF-8', 'UTF-32'))) {

      $content = mb_convert_encoding($content, 'UTF-8');

      if (mb_check_encoding($content, 'UTF-8')) {
        // log('Converted to UTF-8');
      } else {
        // log('Could not convert to UTF-8');
      }
    }
    return $content;
  }
  
  
}