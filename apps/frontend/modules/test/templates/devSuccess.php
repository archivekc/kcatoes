
<p>Tests à implémenter</p>
  <?php foreach($tests as $test): ?>
    <ul>
      <li><?php echo $test->getNom() ?></li>
      <li><?php echo $test->getNomCourt() ?></li>
      <li><?php echo $test->getDescription() ?></li>
    </ul>
  <?php endforeach ?>