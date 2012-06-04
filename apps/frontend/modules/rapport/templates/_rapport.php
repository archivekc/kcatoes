<?php if(!is_null($titre)): ?>
  <h4><?php echo $titre ?></h4>
<?php endif; ?>

<ul class="rapport">

  <li>
    <span class="label">Total </span> :
    <span class="count"><?php echo $totaux['total'] ?></span>
  </li>

  <li>
    <span class="label">Applicables </span> :
    <span class="count"><?php echo $totaux['applicables'] ?></span>
  </li>

  <?php foreach($totaux['resultat'] as $result => $total): ?>
    <li>
      <span class="label"><?php echo $result ?></span> :
      <span class="count"><?php echo $total ?></span>
    </li>
  <?php endforeach;?>

  <li>
    <span class="label">Score </span> :
    <span class="score"><?php echo round($totaux['score']) ?> %</span>
  </li>

</ul>