<?php if(!$done): ?>

  <h1>Tests en cours d'exécution</h1>
  <p>
    Tests exécutés : 
     <span id="count"><?php    echo $count    ?></span>
   / <span id="total"><?php    echo $total    ?></span>
    (<span id="pourcent"><?php echo $pourcent ?></span> %)
  </p>

  <div id="staticProgressbar" class="ui-progressbar ui-widget ui-widget-content ui-corner-all" 
       role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?php echo $pourcent ?>"><div 
       class="ui-progressbar-value ui-widget-header ui-corner-left" style="width: <?php echo $pourcent ?>%;"></div></div>
  
  <div id="jsProgressbar"></div>
   
  <script type="text/javascript">
    $(document).ready(function(){

      $('#staticProgressbar').hide();
      $('#jsProgressbar').progressbar({ value: <?php echo $pourcent ?> });

      var interval = 1500;

      var updateRequest = function(){
        $.ajax({
           type: 'get'
          ,url: window.location.href
          ,dataType: 'json'
          ,success: function(data){
             updateHandler(data);
          }
        });
      };

      var updateHandler = function(data){
        if (!data.done){
          doUpdate(data)
          window.setTimeout(updateRequest, interval);
        }
        else {
          data.total = $('#total').html();
          data.count = data.total;
          data.pourcent = 100;
          doUpdate(data);
          parent.location.reload();
        }
      };
      
      var doUpdate = function(data){
        $('#count').html(data.count);
        $('#total').html(data.total);
        $('#pourcent').html(data.pourcent);
        $("#jsProgressbar").progressbar({ value: data.pourcent });
      }

      window.setTimeout(updateRequest, interval);
      
    });
  </script>
  
  
<?php else: ?>

  <h1>Tests exécutés</h1>
  <p>
    Veuillez <a id="refreshLink" href="<?php echo url_for('scenarioDetail', $scenario) ?>" target="_parent">actualiser la page</a>
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
