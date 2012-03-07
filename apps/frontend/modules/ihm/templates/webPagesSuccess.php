<h1><span>Pages web</span></h1>
<form method="post" action="<?php echo url_for('ihm/WebPages')?>">
  <div>
    <?php $addPageForm->renderGlobalErrors() ?>
  </div>
  <div>
    <?php echo $addPageForm->renderHiddenFields()?>
  </div>
  <div>
    <?php echo $addPageForm['url']->renderError()?>
		<?php echo $addPageForm['url']->renderLabel()?>&nbsp;:
		<?php echo $addPageForm['url']->render()?><br/>
  </div>
  <div>
    <?php echo $addPageForm['description']->renderError()?>
    <?php echo $addPageForm['description']->renderLabel()?>&nbsp;:
    <?php echo $addPageForm['description']->render()?><br/>
  </div>
	<div>
    <input type="submit" value="Ajouter"/>
	</div>
</form>
<?php if (count($pages)): ?>
<ul>
  <?php foreach($pages as $page):?>
  <li>
    <a href="<?php echo url_for('webPage', array('id'=>$page['id']))?>" class="url"><?php echo $page['url']?></a>
    <a href="<?php echo url_for('deleteWebPage', array('id'=>$page['id']))?>" class="action supprimer">Supprimer</a>
    <p class="urlDescription"><?php echo $page['description']?></p>
  </li>
  <?php endforeach; ?>
</ul>
<?php else: ?>
	Aucune page n'est renseignée
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