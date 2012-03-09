<?php
error_reporting(E_ALL);

###FIELDS###
date_default_timezone_set('Europe/Paris');

$output = file_get_contents('./output.html');
$autosave = isset($_GET['autosave'])?true:false;

$value = isset($_POST['score'])?htmlentities($_POST['score']):'';
$input = '<input type="hidden" id="score" name="score" type="text" readonly="readonly" value="'.$value.'"/>';
$span = '<span class="scoreValue">'.$value.'</span>';

$output = preg_replace('/<input[^>]*?id="score".*?\/>/u', $input, $output);
$output = preg_replace('/<span[^>]*?class="scoreValue".*?span>/u', $span, $output);

foreach ($fields['select'] as $field)
{
	$value = isset($_POST[$field])?htmlentities($_POST[$field]):'';
	$list = getResultatListe($field, $value);
	$output = preg_replace('/<select[^>]*?id="'.$field.'.*?select>/u', $list, $output);
}
  

foreach ($fields['textarea'] as $field)
{
	$value = isset($_POST[$field])?htmlentities($_POST[$field]):'';
	$textarea = '<textarea id="'.$field.'" name="'.$field.'" rows="5" cols="20">'.$value.'</textarea>';
	$output = preg_replace('/<textarea[^>]*?id="'.$field.'.*?textarea>/u', $textarea, $output);
}

if ($autosave)
{
	$filename = './auto_save.html';
  file_put_contents($filename, $output);
}
else
{
	$filename = './'.time().'_output.html';
	file_put_contents($filename, $output);
	header('location: '.$filename);	
}

  
function getResultatListe($name, $value = null)
{
  $id = $name;
  $available = array(
    'REUSSITE' => 'Réussite'
    ,'ECHEC' => 'Echec'
    ,'NA' => 'N/A'
    ,'MANUEL' => 'Manuel'
  );
  $select = '<select id="'.$id.'" name="'.$id.'">';
  foreach($available as $code => $label)
  {
    $selected = '';
    if ($value == $code)
    {
      $selected = 'selected="selected"';
    }
    $select .= '<option '.$selected.' value="'.$code.'">'.$label.'</option>';
  }
  $select .= '</select>';
  return $select;
}
  
function computeIdForTest($value)
{
  return 'test_'.preg_replace('#[^a-zA-z0-9-_]#', '_', $value);
}