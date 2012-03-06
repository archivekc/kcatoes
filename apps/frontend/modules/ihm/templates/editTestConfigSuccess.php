<h1><span>Configurations de test: <?php echo $config->getLibelle() ?></span></h1>
<form action="<?php echo url_for('editTestConfig', array('id' => $config->getId()))?>"  method="post">
  <div class="submit">
    <input type="submit" value="Modifier"/>
  </div>
	<ul>
	  <?php foreach($availableTests as $test):?>
	  <li>
	    <?php $checked = (in_array($test, $sf_data->getRaw('selectedTests')))?'checked="checked"':''?>
	    <input <?php echo $checked?> type="checkbox" name="tests[]" id="test_<?php echo $test ?>" value="<?php echo $test?>"/>
	    <label for="test_<?php echo $test ?>"><?php echo ASource::getLibelle($test); ?></label>
	  </li>
	  <?php endforeach; ?>
	</ul>
	<div class="submit">
    <input type="submit" value="Modifier"/>
  </div>
</form>
