  <form method="post" action="<?php echo url_for('pageTests',array('id'=>$page->getId()))?>" 
        class="highlight">

    <div class="fields">
    
      <?php if ($sf_user->hasFlash('webPageTestsMsg')): ?>
        <div class="info">
          <?php echo $sf_user->getFlash('webPageTestsMsg') ?>
        </div>
      <?php endif; ?>
    
      <?php if ($testsForm->hasGlobalErrors()):?>
        <div>
          <?php $testsForm->renderGlobalErrors() ?>
        </div>
      <?php endif ?>
      <div>
        <?php echo $testsForm->renderHiddenFields()?>
      </div>
      
      <ul>
        <?php foreach($allTests as $testClass): ?>
          <li> 
            <?php echo $testsForm[$testClass]->renderError() ?>
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