<?php use_helper('I18N', 'Date') ?>
<?php include_partial('sfGuardGroup/assets') ?>

<div id="sf_admin_container" class="block">
  <h1><?php echo __('Liste des profils', array(), 'messages') ?></h1>

  <?php include_partial('sfGuardGroup/flashes') ?>
    <?php include_partial('sfGuardGroup/list_actions', array('helper' => $helper)) ?>

  <div id="sf_admin_header">
    <?php include_partial('sfGuardGroup/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_bar">
    <?php include_partial('sfGuardGroup/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('sfGuardGroup/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <?php include_partial('sfGuardGroup/list_batch_actions', array('helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('sfGuardGroup/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
