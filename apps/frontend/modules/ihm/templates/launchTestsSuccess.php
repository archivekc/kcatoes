<h1>Lancement des tests</h1>

<h2>Page testée : <?php echo $page->getUrl(); ?></h2>
<p>
<?php echo $page->getDescription(); ?>
</p>

<br />

<h2>Liste des tests à passer : </h2>
<ul>
  <?php foreach ($tab_tests as $test): ?>
    <li>
      <?php echo $test['class'] ?>
      <?php if (! $test['implemente']) : ?>
        (non implémenté)
      <?php endif; ?>
    </li>
  <?php endforeach;?>
</ul>

<br />
 
<ul>
  <li><a href="<?php echo $resultUrlRoot ?>output.html" target="_blank"> Voir les résultats </a></li>
  <li><a href="<?php echo $resultUrlRoot ?>tested.html" target="_blank"> Voir la page testée </a></li>
</ul>



                                              



