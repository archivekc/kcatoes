<?php

/**
 * sfGuardUser module helper.
 *
 * @package    sfGuardPlugin
 * @subpackage sfGuardUser
 * @author     Fabien Potencier
 * @version    SVN: $Id: sfGuardUserGeneratorHelper.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardUserGeneratorHelper extends BaseSfGuardUserGeneratorHelper
{


  public function linkToList($params)
  {
    return '<li class="sf_admin_action_list">'.link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('list')).'</li>';
  }

  public function linkToSave($object, $params)
  {
    return '<li class="sf_admin_action_save"><input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" /></li>';
  }

  public function linkToSaveAndAdd($object, $params)
  {
    if (!$object->isNew())
    {
      return '';
    }

    return '<li class="sf_admin_action_save_and_add"><input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="_save_and_add" /></li>';
  }

}
