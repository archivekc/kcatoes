<?php if(!$done): ?>

  <h1>Tests en cours d'exécution</h1>
  <p>
    Tests exécutés : <?php echo $count ?>/<?php echo $total ?>
    (<?php echo $pourcent ?> %)
  </p>
  <div id="progressbar" class="ui-progressbar ui-widget ui-widget-content ui-corner-all" 
       role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo $pourcent ?>"><div 
       class="ui-progressbar-value ui-widget-header ui-corner-left" style="width: <?php echo $pourcent ?>%;"></div></div>
   
<?php else: ?>

  <h1>Tests exécutés</h1>
  <p>
    Veuillez <a id="refreshLink" href="<?php echo url_for('scenarioDetail', $scenario) ?>">actualiser la page</a>
  </p>

  <script type="text/javascript">
    $(document).ready(function(){
      var doReload = function (){
        parent.location.reload();
        return false;
      }
      $('#refreshLink').click(function(){
        return doReload();
      });
      
      parent.setTimeout(doReload, 5000);
    });
  </script>

<?php endif; ?>
