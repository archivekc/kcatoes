<h1>Lancement des tests sur <strong><?php echo $page->getUrl(); ?></strong></h1>

<p class="description">
  <?php echo $page->getDescription(); ?> 
</p>

<h2>Liste des tests passés : </h2>
<ul>
  <?php foreach ($tab_tests as $test): ?>
    <li>
      <?php echo $test['class']::testName ?>
      <?php if (! $test['implemente']) : ?>
        (non implémenté)
      <?php endif; ?>
    </li>
  <?php endforeach;?>
</ul>

<ul>
  <li><a href="<?php echo $resultUrlRoot ?>output.html" target="_blank"> Voir les résultats </a></li>
  <li><a href="<?php echo url_for('webPage', array('id'=>$page->getId()))?>">Retour à l'écran précédent</a></li>
</ul>
