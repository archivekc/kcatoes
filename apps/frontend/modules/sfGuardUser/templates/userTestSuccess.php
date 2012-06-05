  <form method="post" action="<?php echo url_for('userTest')?>" 
        class="block testForm">
    <h2>Tests</h2>
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
              <?php endif;?>
              <label for="test_<?php echo $escapedTest?>"><?php echo  $test::getIdLibelle().' ('.$test::getGroup('niveau').')'?></label> 
          </li>    
        <?php endforeach; ?>
      </ul>
      
    <input type="submit" value="Enregistrer" />
    
    <a id="check_all" href="#">Sélectionner tout</a>
  </form>
  
  <script type="text/javascript">
    $('#check_all').toggle(
          function(){$('input[type=checkbox]').attr('checked', true);} 
        , function(){$('input[type=checkbox]').attr('checked', false);}
    );
  </script>