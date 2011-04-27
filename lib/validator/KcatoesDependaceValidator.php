<?php

class KcatoesDependanceValidator extends sfValidatorDoctrineUnique
{
  /**
   * @see sfValidatorDoctrineChoice
   */
  protected function doClean($values)
  {
    $clean = parent::doClean($values);

    $currentId = $values['id'];
    $errorMessage = 'Un test ne peut pas faire partie de ses propres dépendances';
    $dependances = array();

    $parent = TestTable::getInstance()->findOneById($clean['dependance_id']);
    array_merge($dependances, $parent->getExecutionList());
    $dependances[] = $parent;

    sfContext::getInstance()->getLogger()->info($parent);

    foreach ($dependances as $dependance)
    {
      sfContext::getInstance()->getLogger()->info($dependance);

      if ($dependance->getId() == $currentId)
      {
        $error = new sfValidatorError($this, $errorMessage, array('column' => 'id', 'column' => 'dependance_id'));
        throw new sfValidatorErrorSchema($this, array('dependance_id' => $error));
      }
    }

    return $clean;
  }
}