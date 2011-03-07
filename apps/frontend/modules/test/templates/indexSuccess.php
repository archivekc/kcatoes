<h1>Paramétrage (1/n)</h1>

<p>Url choisie : <?php echo $urlDeTest ?></p>

<p>Tests choisis :</p>
<ul>
  <?php foreach($tests as $test): ?>
    <li><?php echo $test->getNom() ?></li>
  <?php endforeach ?>
</ul>

<?php echo link_to('Lancer les tests', 'test/execute') ?>
