
<?php $form->renderGlobalErrors() ?>
<form method="post" action="<?php echo url_for('test/url') ?>">
  <?php $form->renderHiddenFields()?>
  <?php echo $form['url']->renderError()?>
  <p>
	  <?php echo $form['url']->renderLabel()?>&nbsp;:
	  <?php echo $form['url']->render()?>
	  <input type="submit" value="Suivant" />
  </p>
</form>