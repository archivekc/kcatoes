<?php use_helper('I18N', 'Date') ?>
<?php include_partial('sfGuardGroup/assets') ?>

<div id="sf_admin_container" class="block addEditGroup">
  <h1><?php echo __('Modifier le profil "<strong>%%name%%</strong>"', array('%%name%%' => $sfGuardGroup->getName()), 'messages') ?></h1>

  <?php include_partial('sfGuardGroup/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('sfGuardGroup/form_header', array('sfGuardGroup' => $sfGuardGroup, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('sfGuardGroup/form', array('sfGuardGroup' => $sfGuardGroup, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('sfGuardGroup/form_footer', array('sfGuardGroup' => $sfGuardGroup, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
