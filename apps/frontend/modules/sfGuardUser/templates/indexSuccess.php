<?php use_helper('I18N', 'Date') ?>
<?php include_partial('sfGuardUser/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Liste des utilisateurs', array(), 'messages') ?></h1>

  <?php include_partial('sfGuardUser/flashes') ?>
    <?php include_partial('sfGuardUser/list_actions', array('helper' => $helper)) ?>

  <div id="sf_admin_header">
    <?php include_partial('sfGuardUser/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('sfGuardUser/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('sfGuardUser/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <?php include_partial('sfGuardUser/list_batch_actions', array('helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('sfGuardUser/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
