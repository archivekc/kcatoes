<?php use_helper('Ihm') ?>
<?php if ($sf_user->hasFlash('notice')): ?>
  <?php echo userMsg(__($sf_user->getFlash('notice'), array(), 'sf_admin') , 'info') ?>
<?php endif; ?>

<?php if ($sf_user->hasFlash('error')): ?>
	<?php echo userMsg(__($sf_user->getFlash('error'), array(), 'sf_admin') , 'error') ?>
<?php endif; ?>
