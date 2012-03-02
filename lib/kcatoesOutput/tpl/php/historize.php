<?php 
  /**
   * Génére un select html listant les différentes valeurs de résultat
   * @param String $name le nom de la liste (génére l'attribut id est name)
   * @param Int $value (optionnal) si fourni, alors la valeur est sélectionnée
   *        par défaut
   * @return String code html de la liste
   */
  function getResultatListe($name, $value = null)
  {
    $id = $this->computeIdForTest($name);
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
      $select .= '<option '.$selected.' value="'.$code.'">'.$value.'</option>';
    }
    $select .= '</select>';
    return $select;
  }
  
  function computeIdForTest($value)
  {
    return 'test_'.preg_replace('#[^a-zA-z0-9-_]#', '_', $value);
  }