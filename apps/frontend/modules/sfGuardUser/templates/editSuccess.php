<?php use_helper('I18N', 'Date') ?>
<?php include_partial('sfGuardUser/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Modifier l\'utilisateur "<strong>%%username%% (%%last_name%% %%first_name%%)</strong>"', array('%%username%%' => $utilisateur->getUsername(), '%%last_name%%' => $utilisateur->getLastName(), '%%first_name%%' => $utilisateur->getFirstName()), 'messages') ?></h1>

  <?php include_partial('sfGuardUser/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('sfGuardUser/form_header', array('utilisateur' => $utilisateur, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('sfGuardUser/form', array('utilisateur' => $utilisateur, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('sfGuardUser/form_footer', array('utilisateur' => $utilisateur, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
