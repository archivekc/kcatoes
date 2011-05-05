<h2><span>Configuration des tests - Confirmation</span></h2>
<p>Récapitulatif de votre sélection:</p>
<ul>
  <?php foreach ($selectedTests as $test): ?>
    <li><?php echo $test ?></li>
  <?php endforeach ?>
</ul>
<p>Total: <?php echo $testCount ?> test(s) sélectionné(s)</p>
<p>
  <a href="<?php echo url_for('test/thematique?recommencer=true') ?>" >Recommenecer la sélection</a>
  <a href="<?php echo url_for('test/confirmation?valide=true') ?>" >Lancer les tests</a>
</p>