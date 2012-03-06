<?php
/*
This file is part of KCatoès.

    KCatoès is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    KCatoès is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with KCatoès.  If not, see <http://www.gnu.org/licenses/>.
    
    Copyright (C) 2010, Key Consulting (France)
    Written by Cyril FABBY - contact.kcatoes@keyconsulting.fr
*/

$url = isset($_POST['url']) ? $_POST['url'] : '';
$log = json_decode(isset($_POST['log']) ? $_POST['log'] : '');


if (empty($url) || empty($log))
{
  return false;
}
else
{
  $lines = $log;
  $str = '';
	
	$outstream = fopen('php://temp', 'w');
  
  function __outputCSV(&$vals, $key, $filehandler) {
      if (isset($vals->hint) && is_array($vals->hint)){
        $vals->hint = implode($vals->hint, "\n");
      }
      $line = array();
      $line['id'] = utf8_decode($vals->id);
      $line['level'] = utf8_decode($vals->level);
      $line['label'] = utf8_decode($vals->label);
      $line['status'] = utf8_decode($vals->status);
      $line['selector'] = utf8_decode($vals->selector);
      $line['hint'] = utf8_decode(isset($vals->hint)? $vals->hint:'');
      
      fputcsv($filehandler, $line, ';', '"');
  }
  
  $header = new stdclass;
  $header->id = 'Id';
  $header->level = 'Niveau';
  $header->label = 'Intitulé';
  $header->status = 'Résultat';
  $header->selector = 'Sélecteur jQuery';
  $header->hint = 'Indices';
  
  __outputCSV($header, null, $outstream);
  array_walk($lines, '__outputCSV', $outstream);

	rewind($outstream);
	$str = stream_get_contents($outstream);
	fclose($outstream);


	$size = strlen($str);
	$filename = 'test-audit.csv';

	header('Content-Type: text/csv; name="'.$filename.'"'); 
	header('Content-Transfer-Encoding: binary'); 
	header('Content-Length: '.$size); 
	header('Content-Disposition: attachment; filename="'.$filename.'"'); 
	header('Expires: 0'); 
	header('Cache-Control: no-cache, must-revalidate');
	header('Pragma: no-cache');
	
	echo $str;
	
	exit();
}
?>