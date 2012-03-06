<?php

/**
 * Base project form.
 *
 * @package    Kcatoes
 * @subpackage form
 * @author Adrien Couet <adrien.couet@keyconsulting.fr>
 */
class BaseForm extends sfFormSymfony
{
  public function configure()
  {
    $this->widgetSchema->setFormFormatterName('KCatoes');
  }

}
