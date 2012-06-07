<?php /* Déséchappement */ ?>
<?php $rowspan = $sf_data->getRaw('rowspan') ?>
<?php $result  = $sf_data->getRaw('result') ?>

<li class="<?php echo Resultat::getCode($result['result']) ?>">
  <div>
	  <h2>
	    <span class="testId"><?php echo $test::testId ?></span>
	    <span class="testTitle"><?php echo $test::testName ?></span>
	  </h2>
	  <div class="groups">
	    <strong>Regroupements</strong>
	    <?php echo Tester::arrayToHtmlList($test::getGroups()) ?>
	  </div>
	  <div class="testProc"><h3>Procédure de test&nbsp;:</h3><?php echo Tester::arrayToHtmlList($test::getProc(), true) ?></div>
	  
	  <div class="globalAndDoc">
	    <div class="testDoc"><h3>Documentation&nbsp;:</h3><?php echo Tester::arrayToHtmlList($test::getDocLinks(), true) ?></div>
	  
		  <div class="global">
		  <h3>Résultat global</h3>
		  <?php if ($history): ?>
		    <?php $id   = 'mainResult_'.$test::testId ?>
		    <?php $name = 'mainResult_'.$result['id'] ?>
		    <div class="testStatus">
		      <?php //echo Resultat::getLabel($result['result'])?>
		      <span class="computed"><?php echo Resultat::getLabel($result['result']) ?></span>
		      <?php echo Tester::getResultatListe($id, $result['result'], $name) ?>
		    </div>
		  <?php else: ?>
		    <div class="testStatus"><?php echo Resultat::getLabel($result['result']) ?></div>
		  <?php endif ?>
		  </div>
		</div>  
		  
		  
	  <?php if ($nbLigne > 0): ?>
	    <h3>Résultat par élément</h3>
	    <ul class="elemsResult">
	     <?php $cptLine = -1 ?>
	     <?php foreach ($result['CollectionLines'] as $resultLine): ?>
	      <?php $cptLine++ ?>
	      <li>
	        <?php if ($history): ?>
	          <?php /* résultat de base + liste */ ?>
	          <?php $id   = 'subResult'.$cptLine.'_'.$test::testId ?>
	          <?php $name = 'subResult_'.$resultLine['id'] ?>
	          <div class="subResult <?php echo Resultat::getCode($resultLine['result']) ?>">
	            <span class="computed"><?php echo Resultat::getLabel($resultLine['result']) ?></span>
	            <?php echo Tester::getResultatListe($id, $resultLine['result'], $name) ?>
	          </div>
	        <?php else: ?>
	          <div class="subResult"><?php echo Resultat::getLabel($resultLine['result']) ?></div>
	        <?php endif ?>
	        
	        
	        <div class="context">
	        
	          <?php $comment = '' ?>
	          <?php if (strlen($resultLine['comment'])): ?>
	            <?php 
	              $comment = '<li class="comment"><h4>Retour du test&nbsp;:</h4> '.
	                           '<div class="value">'.$resultLine['comment'].'</div></li>';
	            ?>
	          <?php endif ?>
	          
	          <?php $source = '' ?>
	          <?php if (strlen($resultLine['source'])): ?>
	            <?php 
	
	              
	              $source = '<li class="source"><h4>Source&nbsp;:</h4> '.
	                          '<div class="value">'.$resultLine['prettySource'].'</div></li>';
	            ?>              
	          <?php endif ?>
	          
	          <?php $css = '' ?>
	          <?php if (strlen($resultLine['css_selector'])): ?>
	            <?php 
	              $css = '<li class="cssSelector"><h4>Sélecteur CSS&nbsp;:</h4> '.
	                       '<div class="value"><pre>'.$resultLine['css_selector'].'</pre></div></li>';
	            ?>
	          <?php endif ?>
	          
	          <?php $context = $comment.$source.$css; ?>
	          <?php if (strlen(trim($context)) > 0): ?>
	            <ul><?php echo $context ?></ul>
	          <?php endif ?>
	          
	          <?php if ($history): ?>
	            <?php $id   = Tester::computeIdForTest('annot'.$cptLine.'_'.$test::testId) ?>
	            <?php $name = ('annot_'.$resultLine['id']) ?>
	            <div class="annotation"><h4>Annotation&nbsp;</h4>
	              <textarea id="<?php echo $id ?>" name="<?php echo $name ?>" cols="20" rows="5"><?php echo $resultLine['annotation'] ?></textarea>
	            </div>
	          <?php endif; ?>
	           
	        </div>
	      </li>
	     <?php endforeach ?>
	    </ul>
	  <?php endif ?>
	 </div>
</li>
<?php /*?>


//  <tr class="<?php echo Resultat::getCode($result['result']) ?>">
//    <th <?php echo $rowspan ?> class="testId"><?php echo $test::testId ?></th>
//    <td <?php echo $rowspan ?> class="groups"><?php echo Tester::arrayToHtmlList($test::getGroups()) ?></td>
//    <td <?php echo $rowspan ?> class="testInfo">
//      <strong><?php echo $test::testName ?></strong>
//      <div class="testProc"><strong>Procédure de test&nbsp;:</strong><?php echo Tester::arrayToHtmlList($test::getProc(), true) ?></div>
//      <div class="testDoc"><strong>Documentation&nbsp;:</strong><?php echo Tester::arrayToHtmlList($test::getDocLinks(), true) ?></div>
//    </td>
      
//    <?php if ($history): ?>
//      <?php $id   = 'mainResult_'.$test::testId ?>
//      <?php $name = 'mainResult_'.$result['id'] ?>
//      <td <?php echo $rowspan ?> class="testStatus">
//        <?php //echo Resultat::getLabel($result['result'])?>
//        <span class="computed"><?php echo Resultat::getLabel($result['result']) ?></span>
//        <?php echo Tester::getResultatListe($id, $result['result'], $name) ?>
//      </td>
//    <?php else: ?>
//      <td <?php echo $rowspan ?> class="testStatus"><?php echo Resultat::getLabel($result['result']) ?></td>
//    <?php endif ?>
      
//    <?php if ($nbLigne == 0): ?>
    
      <td colspan="2"></td></tr>
        
    <?php else: ?>

      <?php $first = true ?>
//      <?php $cptLine = -1 ?>
      
      <?php foreach ($result['CollectionLines'] as $resultLine): ?>
      
//        <?php $cptLine++ ?>
        <?php if (!$first): ?>
          <tr>
        <?php endif ?>
        
        <?php $first = false ?>
        
        <?php if ($history): ?>
          <?php // résultat de base + liste  ?>
//          <?php $id   = 'subResult'.$cptLine.'_'.$test::testId ?>
//          <?php $name = 'subResult_'.$resultLine['id'] ?>
//          <td class="subResult <?php echo Resultat::getCode($resultLine['result']) ?>">
//            <span class="computed"><?php echo Resultat::getLabel($resultLine['result']) ?></span>
//            <?php echo Tester::getResultatListe($id, $resultLine['result'], $name) ?>
//          </td>
//        <?php else: ?>
//          <td class="subResult"><?php echo Resultat::getLabel($resultLine['result']) ?></td>
//        <?php endif ?>

        <td class="context">
        
          <?php $comment = '' ?>
          <?php if (strlen($resultLine['comment'])): ?>
            <?php 
              $comment = '<li class="comment"><strong>Retour du test&nbsp;:</strong> '.
                           '<div class="value">'.$resultLine['comment'].'</div></li>';
            ?>
          <?php endif ?>
          
          <?php $source = '' ?>
          <?php if (strlen($resultLine['source'])): ?>
            <?php 

              
              $source = '<li class="source"><strong>Source&nbsp;:</strong> '.
                          '<div class="value">'.$resultLine['prettySource'].'</div></li>';
            ?>              
          <?php endif ?>
          
          <?php $css = '' ?>
          <?php if (strlen($resultLine['css_selector'])): ?>
            <?php 
              $css = '<li class="cssSelector"><strong>Sélecteur CSS&nbsp;:</strong> '.
                       '<div class="value"><pre>'.$resultLine['css_selector'].'</pre></div></li>';
            ?>
          <?php endif ?>
          
          <?php $context = $comment.$source.$css; ?>
          <?php if (strlen(trim($context)) > 0): ?>
            <ul><?php echo $context ?></ul>
          <?php endif ?>
          
          <?php if ($history): ?>
            <?php $id   = Tester::computeIdForTest('annot'.$cptLine.'_'.$test::testId) ?>
            <?php $name = ('annot_'.$resultLine['id']) ?>
            <div class="annotation"><strong>Annotation&nbsp;</strong>
              <textarea id="<?php echo $id ?>" name="<?php echo $name ?>" cols="20" rows="5"><?php echo $resultLine['annotation'] ?></textarea>
            </div>
          <?php endif; ?>
           
        </td>
        </tr>

      <?php endforeach ?>
      
    <?php endif ?>
    
    <?php */?>