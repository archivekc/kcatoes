  <form method="post" action="<?php echo url_for('pageTests',array('id'=>$page->getId()))?>" 
        class="block testForm">
    <h2>Tests</h2>
    <div class="fields">
    
      <?php if ($sf_user->hasFlash('webPageTestsMsg')): ?>
        <?php echo userMsg($sf_user->getFlash('webPageTestsMsg'), 'success') ?>
      <?php endif; ?>
    
      <?php if ($testsForm->hasGlobalErrors()):?>
        <div>
          <?php $testsForm->renderGlobalErrors() ?>
        </div>
      <?php endif ?>
      <div>
        <?php echo $testsForm->renderHiddenFields()?>
      </div>
      
     
      <?php $currentThematique = '';?>
        <?php $first = true; ?>
        
        <?php foreach($allTests as $testClass): ?>
          <?php $testThematique = $testClass::getGroup('thematique') ?>
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
            <?php echo $testsForm[$testClass]->renderError() ?>
            <?php //echo var_dump($testsForm[$testClass])?>
            <?php echo $testsForm[$testClass]->render() ?>
            <?php 
              echo $testsForm[$testClass]->renderLabel() 
              ?>
          </li>    
        <?php endforeach; ?>
      </ul>
    </div>
      
    <input type="submit" value="Enregistrer" />
    
    <a id="check_all" href="#">Sélectionner tout</a>
  </form>
  
  <script type="text/javascript">
    $('#check_all').toggle(
          function(){$('input[type=checkbox]').attr('checked', true);} 
        , function(){$('input[type=checkbox]').attr('checked', false);}
    );
  </script>