<?php use_helper('I18N', 'Date') ?>
<?php include_partial('sfGuardPermission/assets') ?>

<div id="sf_admin_container" class="block addEditPermission">
  <h1><?php echo __('Nouveau rôle', array(), 'messages') ?></h1>

  <?php include_partial('sfGuardPermission/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('sfGuardPermission/form_header', array('sfGuardPermission' => $sfGuardPermission, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('sfGuardPermission/form', array('sfGuardPermission' => $sfGuardPermission, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('sfGuardPermission/form_footer', array('sfGuardPermission' => $sfGuardPermission, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
