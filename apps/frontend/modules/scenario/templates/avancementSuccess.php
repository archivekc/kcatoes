<?php /*
<input type="hidden" id="progressbarValue" name="progressbarValue" value="<?php echo $pourcent ?>" />
<div id="progressbar"></div>
*/ ?>

<?php if(!$done): ?>

  <h1>Tests en cours d'exécution</h1>
  <p>
    Tests exécutés : <?php echo $count ?>/<?php echo $total ?>
    (<?php echo $pourcent ?> %)
  </p>
  <div id="progressbar" class="ui-progressbar ui-widget ui-widget-content ui-corner-all" 
       role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo $pourcent ?>"><div 
       class="ui-progressbar-value ui-widget-header ui-corner-left" style="width: <?php echo $pourcent ?>%;"></div></div>
  <?php /*
  <script type="text/javascript">
    $(document).ready(function(){
      $("#progressbar").progressbar({ value: <?php echo $pourcent ?> });
    });
  </script>
   */  ?>
   
<?php else: ?>

  <h1>Tests exécutés</h1>
  <p>
    Veuillez <a id="refreshLink" href="<?php echo url_for('scenarioDetail', $scenario) ?>">actualiser la page</a>
  </p>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#refreshLink').click(function(){
        parent.location.reload();
        return false;
      });
    });
  </script>

<?php endif; ?>
