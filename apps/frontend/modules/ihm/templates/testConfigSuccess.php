<h1><span>Configurations de test: <?php echo $config->getLibelle() ?></span></h1>
<a href="<?php echo url_for('editTestConfig', array('id'=>$config['id']))?>">Modifier</a>
<?php if (count($config->getCollectionTests())): ?>
<ul>
  <?php foreach($config->getCollectionTests() as $test):?>
  <li>
    <?php echo ASource::getLibelle($test->getClass()) ?>
  </li>
  <?php endforeach; ?>
</ul>
<?php  else: ?>
	Aucun test n'est renseigné
<?php  endif; ?>