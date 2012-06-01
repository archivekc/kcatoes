<h3><?php echo $titre ?></h3>
<ul>
  <?php foreach($totaux as $result => $total): ?>
    <li>
      <span><?php echo $result ?></span> : 
      <span><?php echo $total ?></span>
    </li>
  <?php endforeach;?>
</ul>