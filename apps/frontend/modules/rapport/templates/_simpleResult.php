<?php
switch ($depth)
{
	case 1:
	case 2:
	case 3:
	case 4:
	case 5:
		$headG = 'h'.$depth;
		$headT = 'h'.(int)((int)$depth + 1);
	  break;
	case 6:
		 $headG = 'h'.$depth;
		 $headT = 'strong';
	default:
		$headG = 'strong';
		$headT = 'em';
}

?>

  <?php include_partial('result', array( 'resultData' => $resultData['GLOBAL']
                                         ,'head' => $headG
                                         ,'title' => 'Global'
                                         ,'showExecError' => $showExecError)) ?>
  
   
   <div class="thematiqueReportHolder">
	  <<?php echo $headG?> class="thematiqueTitle">Par thématique</<?php echo $headG ?>>
	  <div class="reportBythematique">
		  <?php foreach($resultData['THEMATIQUE'] as $thematique => $result):?>
		    <div>
		    <?php include_partial('result', array( 'resultData' => $result
                                         ,'head' => $headT
                                         ,'title' => $thematique
                                         ,'showExecError' => $showExecError)) ?>
        </div>
		  <?php endforeach ?>
		</div>
  </div>