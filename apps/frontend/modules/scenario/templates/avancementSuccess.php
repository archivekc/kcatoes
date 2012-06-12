<h1>Tests en cours d'exécution</h1>
<p>
  Tests exécutés : <?php echo $count ?>/<?php echo $total ?>
  (<?php echo $pourcent ?> %)
</p>

<input type="hidden" id="progressbarValue" name="progressbarValue" value="<?php echo $pourcent ?>" />

<div id="progressbar"></div>

<script type="text/javascript">
  $(document).ready(function(){
    $("#progressbar").progressbar({ value: <?php echo $pourcent ?> });
  });
</script>
