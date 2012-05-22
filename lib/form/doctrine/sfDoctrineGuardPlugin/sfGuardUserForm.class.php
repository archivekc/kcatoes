<?php

/**
 * sfGuardUser form.
 *
 * @package    kcatoes
 * @subpackage form
 * @author     Key Consulting
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {
  	parent::configure();
    $this->widgetSchema['groups_list'] = new sfWidgetFormDoctrineChoice(array(
        'model' => 'sfGuardGroup'
        ,'expanded' => true
        ,'multiple' => true
      ));
    $this->widgetSchema['permissions_list'] = new sfWidgetFormDoctrineChoice(array(
        'model' => 'sfGuardPermission'
        ,'expanded' => true
        ,'multiple' => true
      ));
  }
}
