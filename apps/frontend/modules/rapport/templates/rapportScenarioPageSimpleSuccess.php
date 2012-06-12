<?php  /*?> 
HIGHLIGHT CELL with 0:

$('td').each(function(){
    if ($(this).text() == 0){
        $(this).text('').css('background', 'orange');
    }
});

<?php */ ?>

<div class="block rapport">
  <h1>Rapport de synthèse de la page: <strong><?php echo $scenarioPage->getNom()?></strong></h1>
  <em><?php echo $scenarioPage->getWebPage()->getUrl()?></em>
  
  <div class="navRapport">
          <?php echo link_to('Retour au rapport du scénario', 'resultatScenario'
                                  ,array('id'=>$scenario->getId()
                                          ,'mode' => 'simple')
                                  ,array('class'=> 'ico detail')
                         );
        ?>
  </div>
  
  <?php include_partial('simpleResult', array( 'resultData' => $sf_data->getRaw('scenarioPageResult')
                                               ,'depth' => 2
                                               ,'showExecError' => false)) ?>
  
  
</div>