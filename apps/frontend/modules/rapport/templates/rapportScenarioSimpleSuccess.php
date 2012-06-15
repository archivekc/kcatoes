<?php  /*?>
HIGHLIGHT CELL with 0:

$('td').each(function(){
    if ($(this).text() == 0){
        $(this).text('').css('background', 'orange');
    }
});

<?php */ ?>

<div class="block rapport">
  <h1>Rapport de synthèse du scénario: <strong><?php echo $scenarioResult['TITLE']?></strong></h1>

  <ul class="navRapport">
    <?php foreach($scenarioPages as $page):?>
    <li>
      <?php 
        $extractIds = array();
        foreach ($page->getWebPage()->getCollectionExtracts() as $extract)
        {
        	array_push($extractIds, $extract->getId());
        }
      ?>
      <?php echo link_to('Rapport de la page &laquo;&nbsp;'. $page->getNom().'&nbsp;&raquo;', 'resultatScenarioPage'
                                  ,array('id'=>$scenario->getId()
                                          ,'idPage' => $page->getWebPage()->getId()
                                          ,'extractIds' => implode('-',$extractIds)
                                          ,'mode' => 'simple')
                                  ,array('class'=> 'ico detail')
                         );
      ?>
    </li>
    <?php endforeach ?>
  </ul>

  <?php include_partial('simpleResult', array( 'resultData' => $sf_data->getRaw('scenarioResult')
                                               ,'depth' => 2
                                               ,'showExecError' => false)) ?>
  
  
</div>
