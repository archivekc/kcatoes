<h1>Configurations de test: <strong><?php echo $config->getLibelle() ?></strong></h1>
<div>
<a class="ico modifier" href="<?php echo url_for('editTestConfig', array('id'=>$config['id']))?>">Modifier</a>
</div>
<?php if (count($config->getCollectionTests())): ?>
<ul>
  <?php foreach($config->getCollectionTests() as $test):?>
  <li>
    <?php $t_class = $test->getClass() ?>
    <?php echo $t_class::getLibelle() ?>
  </li>
  <?php endforeach; ?>
</ul>
<?php  else: ?>
	<p class="zeroFound">Aucun test n'est renseigné</p>
<?php  endif; ?>