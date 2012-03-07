
<?php $form->renderGlobalErrors() ?>
<form method="post" action="<?php echo url_for('test/url') ?>" enctype="multipart/form-data">
  <?php $form->renderHiddenFields()?>
  <?php echo $form['url']->renderError()?>
  <?php echo $form['conf']->renderError()?>
  <?php echo $form['htmlFile']->renderError()?>
  <p class="error_list"><?php echo $error?></p>
  <p>
	  <?php echo $form['url']->renderLabel()?>&nbsp;:
	  <?php echo $form['url']->render()?><br/>

	  <?php echo $form['htmlFile']->renderLabel()?>&nbsp;:
	  <?php echo $form['htmlFile']->render()?>

	  <?php echo $form['conf']->render()?>
	  <input type="submit" value="Suivant" />
  </p>
</form>