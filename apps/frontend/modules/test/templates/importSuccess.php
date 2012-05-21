<h2><span>Configuration des tests - Import d'un fichier de configuration</span></h2>
<form method="post" action="<?php echo url_for('test/import')  ?>" enctype="multipart/form-data">
  <?php $form->renderHiddenFields()?>
  <p class="error_list"><?php echo $error?></p>
  <?php echo $form['configFile']->renderError()?>
  <p>
    <?php echo $form['configFile']->renderLabel()?>
    <?php echo $form['configFile']->render()?>
  </p>
  <p><input type="submit" value="Suivant" /></p>
</form>