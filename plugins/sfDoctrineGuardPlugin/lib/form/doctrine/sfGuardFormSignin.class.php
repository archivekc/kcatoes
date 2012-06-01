<?php

/**
 * sfGuardFormSignin for sfGuardAuth signin action
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardFormSignin.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardFormSignin extends BasesfGuardFormSignin
{
  /**
   * @see sfForm
   */
  public function configure()
  {
    parent::configure();
    
    
    // Configuration des messages
    $this->getValidator('username')->setMessage('required', 'Obligatoire');
    $this->getValidator('password')->setMessage('required', 'Obligatoire');
    $this->getValidatorSchema()->getPostValidator()->setMessage('invalid', 'Le nom et/ou le mot de passe est invalide.');
    
  }
  
}
