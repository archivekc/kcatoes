  <form method="post" action="<?php echo url_for('userTest')?>" 
        class="block testForm">
    <h2>Tests</h2>
    <input type="submit" value="Enregistrer" />
    
    <a class="check_all" href="javascript:void(0)">Sélectionner tout</a>
    <div class="fields">
    
      <?php if ($sf_user->hasFlash('webPageTestsMsg')): ?>
        <?php echo userMsg($sf_user->getFlash('webPageTestsMsg'), 'success') ?>
      <?php endif; ?>
    
      <?php /*if ($testsForm->hasGlobalErrors()):?>
        <div>
          <?php $testsForm->renderGlobalErrors() ?>
        </div>
      <?php endif ?>
      <div>
        <?php echo $testsForm->renderHiddenFields() */?>
      </div>
      
     
      <?php $currentThematique = '';?>
        <?php $first = true; ?>
        
        <?php foreach($allTests as $test): ?>
          <?php $testThematique = $test::getGroup('thematique') ?>
          <?php if (is_null($testThematique)){$testThematique = 'Aucune thématique définie';}?>
          <?php if ($currentThematique != $testThematique):?>
            <?php $currentThematique = $testThematique ?>
            <?php if (!$first):?>
            </ul>
            <input type="submit" value="Enregistrer" />
            <a class="check_all_group">Sélectionner tout ce groupe de tests</a>
            <?php endif ?>
            <h2><?php echo $testThematique?></h2>    
            <ul>
            <?php $first = false ?>
          
          <?php endif ?>
          <li> 
            <?php /* echo $testsForm[$testClass]->renderError() ?>
            <?php echo $testsForm[$testClass]->render() ?>
            <?php 
              echo $testsForm[$testClass]->renderLabel() 
              */?>
              <?php $escapedTest = str_replace('\\', '_', $test) ?>
              <?php if (isset($profilTest[$test])):?>
              <input type="checkbox" id="test_<?php echo $escapedTest?>" name="test[]" value="<?php echo $test?>" <?php echo isset($profilTest[$test])>0?'disabled="disabled" checked="checked"':''?>/>
              <ul class="tags">
                <?php foreach ($profilTest[$test] as $profil):?>
                  <li class="tag"><?php echo $profil?></li>
                <?php endforeach ?> 
              </ul>
              <?php else: ?>
                <?php $checked = in_array($test, $sf_data->getRaw('userTest'))?'checked="checked"':'' ?>
                <input type="checkbox" id="test_<?php echo $escapedTest?>" name="test[]" value="<?php echo $test?>" <?php echo $checked ?>/>
                <?php if ($checked != ''):?>
                <ul class="tags">
                  <li class="tag perso">Perso</li>
                </ul>
                <?php endif ?>
              <?php endif;?>
              <label for="test_<?php echo $escapedTest?>"><?php echo  $test::getIdLibelle().' <strong>('.$test::getGroup('niveau').')</strong>'?></label> 
          </li>    
        <?php endforeach; ?>
      </ul>
      <input type="submit" value="Enregistrer" />
      <a class="check_all_group">Sélectionner tout ce groupe de tests</a>

      <div id="saveUserTest">      
		    <input type="submit" value="Enregistrer" />
		    <a class="check_all" href="javascript:void(0)">Sélectionner tout</a>
	    </div>
  </form>
  
  <script type="text/javascript">
    $('.check_all').toggle(
          function(){
              $('input[type=checkbox]').not('[disabled=disabled]').attr('checked', true);
              $(this).text($(this).text().replace(/Sélectionner/, 'Désélectionner'));
           } 
          ,function(){
              $('input[type=checkbox]').not('[disabled=disabled]').attr('checked', false);
              $(this).text($(this).text().replace(/Désélectionner/, 'Sélectionner'));
           }
    );
    $('.check_all_group').toggle(
    	    function(){
        	    $('input[type=checkbox]', $(this).prev().prev()).not('[disabled=disabled]').attr('checked', true);
        	    $(this).text($(this).text().replace(/Sélectionner/, 'Désélectionner'));
        	 }
    	    ,function(){
        	    $('input[type=checkbox]', $(this).prev().prev()).not('[disabled=disabled]').attr('checked', false);
        	    $(this).text($(this).text().replace(/Désélectionner/, 'Sélectionner'));
        	 }
    );
  </script>