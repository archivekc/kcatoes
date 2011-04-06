<h1>Configuration des tests - Etape 5/5</h1>
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