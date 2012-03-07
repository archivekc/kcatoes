<h1><span>Configurations de test</span></h1>
<form method="post" action="<?php echo url_for('ihm/TestConfigs')?>">
  <div>
    <?php $addTestConfigForm->renderGlobalErrors() ?>
  </div>
  <div>
    <?php echo $addTestConfigForm->renderHiddenFields()?>
  </div>
  <div>
    <?php echo $addTestConfigForm['libelle']->renderError()?>
		<?php echo $addTestConfigForm['libelle']->renderLabel()?>&nbsp;:
		<?php echo $addTestConfigForm['libelle']->render()?><br/>
  </div>
  <div>
    <?php echo $addTestConfigForm['description']->renderError()?>
    <?php echo $addTestConfigForm['description']->renderLabel()?>&nbsp;:
    <?php echo $addTestConfigForm['description']->render()?><br/>
  </div>
	<div>
    <input type="submit" value="Ajouter"/>
	</div>
</form>
<?php if (count($configs)): ?>
<ul>
  <?php foreach($configs as $config):?>
  <li>
    <a href="<?php echo url_for('testConfig', array('id'=>$config['id']))?>" class="url">
      <?php echo $config['libelle']?>
      [<?php echo count($config['CollectionTests'])?> test(s)]
    </a>
    <a href="<?php echo url_for('deleteTestConfig', array('id'=>$config['id']))?>" class="action supprimer">Supprimer</a>
    <p class="urlDescription"><?php echo $config['description']?></p>
  </li>
  <?php endforeach; ?>
</ul>
<?php else: ?>
	Aucune configuration n'est renseignée
<?php endif; ?>


<?php 
/*
 * <?php $form->renderGlobalErrors() ?>
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
 */

?>