<?php

/**
 * sfGuardPermission form.
 *
 * @package    kcatoes
 * @subpackage form
 * @author     Key Consulting
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardPermissionForm extends PluginsfGuardPermissionForm
{
  public function configure()
  {
  	parent::configure();
    $this->widgetSchema['users_list'] = new sfWidgetFormDoctrineChoice(array(
        'model' => 'sfGuardUser'
        ,'multiple' => true
        ,'expanded' => true
      ));
    $this->widgetSchema['groups_list'] = new sfWidgetFormDoctrineChoice(array(
        'model' => 'sfGuardGroup'
        ,'multiple' => true
        ,'expanded' => true
      ));
  }
}
