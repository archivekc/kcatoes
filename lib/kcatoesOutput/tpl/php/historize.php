<?php
error_reporting(E_ALL);

###FIELDS###

$output = file_get_contents('./output.html');

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

$filename = './'.time().'_output.html';
file_put_contents($filename, $output);
header('location: '.$filename);

  
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