<?php

/**
 * Validateur appelé lors de l'ajout ou la modification d'un test via le
 * formulaire généré par Symfony.
 * Vérifie qu'aucune dépendance cyclique n'est créée (un test faisant partie de
 * ses dépendances) et que si le test est défini comme dépendant, alors le
 * champ 'execute_si' est également renseigné.
 * Pour clarifier la base de données, si aucune dépendance n'est définie alors
 * le champ 'execute_si' n'est pas renseigné.
 *
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 *
 */
class KcatoesDependanceValidator extends sfValidatorDoctrineUnique
{
  /**
   * @see sfValidatorDoctrineChoice
   */
  protected function doClean($values)
  {
    $clean = parent::doClean($values);

    if ($clean['dependance_id'] != null)
    {
      $currentId = $clean['id'];
      $parent = TestTable::getInstance()->findOneById($clean['dependance_id']);
      $dependances = $parent->getExecutionList();
      $dependances[] = $parent;

      foreach ($dependances as $dependance)
      {
        if ($dependance->getId() == $currentId)
        {
          $error = new sfValidatorError(
            $this,
            'Un test ne peut pas faire partie de ses propres dépendances',
            array('column' => 'id', 'column' => 'dependance_id')
          );
          throw new sfValidatorErrorSchema($this, array('dependance_id' => $error));
        }
      }

      if ($clean['execute_si'] == null)
      {
        $error = new sfValidatorError(
          $this,
          'Vous devez préciser la condition de dépendance',
          array('column' => 'execute_si')
        );
        throw new sfValidatorErrorSchema($this, array('execute_si' => $error));
      }
    }
    else
    {
      $clean['execute_si'] = null;
    }

    return $clean;
  }
}