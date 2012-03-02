<h1><span>Page&nbsp;: <?php echo $page->getUrl() ?></span></h1>
<p class="description">
  <?php echo $page->getDescription()?>
</p>
<form method="post" action="<?php echo url_for('webPage', array('id'=>$page->getId()))?>">
  <div>
    <?php $addEvalForm->renderGlobalErrors() ?>
  </div>
  <div>
    <?php echo $addEvalForm->renderHiddenFields()?>
  </div>
  <div>
    <?php echo $addEvalForm['config_id']->renderError()?>
    <?php echo $addEvalForm['config_id']->renderLabel()?>&nbsp;:
    <?php echo $addEvalForm['config_id']->render()?><br/>
  </div>
  <div>
    <input type="submit" value="Ajouter"/>
  </div>
</form>
<?php  if (count($evals)): ?>
<ul>
  <?php foreach($evals as $eval):?>
  <li>
    <a href="" class="url"><?php //echo $eval->getConfig()->getLibelle()?></a>
    <a href="" class="action supprimer">Supprimer</a>
  </li>
  <?php endforeach; ?>
</ul>
<?php else: ?>
	Aucune évaluation trouvée
<?php endif; ?>


