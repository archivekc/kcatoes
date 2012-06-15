<span>Ajout d'un type de page</span>
<form method="post" id="scenarioAddPageForm" 
      action="<?php echo url_for('scenarioDetail', array('id'=>$scenario->getId()))?>" 
      class="block <?php echo !$scenarioPageForm->hasErrors()?'quickAddForm':'' ?>">
  <h2>Ajout d'un type de page</h2>
  <div>
    <div class="fields">
      <?php if ($scenarioPageForm->hasGlobalErrors()):?>
        <div>
          <?php $scenarioPageForm->renderGlobalErrors() ?>
        </div>
      <?php endif ?>
      <div>
        <?php echo $scenarioPageForm->renderHiddenFields()?>
      </div>
      <div>
        <?php echo $scenarioPageForm['nom']->renderError()?>
        <?php echo $scenarioPageForm['nom']->renderLabel()?>
        <?php echo $scenarioPageForm['nom']->render()?>
      </div>
      <div>
        <?php echo $scenarioPageForm['required']->renderError()?>
        <?php echo $scenarioPageForm['required']->renderLabel()?>
        <?php echo $scenarioPageForm['required']->render()?>
      </div>
      <div>
        <?php echo $scenarioPageForm['web_page_id']->renderError()?>
        <?php echo $scenarioPageForm['web_page_id']->renderLabel()?>
        <?php echo $scenarioPageForm['web_page_id']->render()?>
      </div>
      
      <div>
        Ou ajouter une nouvelle page : 
      </div>
        
      <div class="subForm">
        <?php $webPageForm = $scenarioPageForm['newWebPage']; ?>
        <div>
          <?php echo $webPageForm['url']->renderError()?>
          <?php echo $webPageForm['url']->renderLabel()?>
          <?php echo $webPageForm['url']->render()?>
        </div>
        <div>
          <?php echo $webPageForm['src']->renderError()?>
          <?php echo $webPageForm['src']->renderLabel()?>
          <?php echo $webPageForm['src']->render()?>
        </div>
        <div>
          <?php echo $webPageForm['description']->renderError()?>
          <?php echo $webPageForm['description']->renderLabel()?>
          <?php echo $webPageForm['description']->render()?>
        </div>
      </div>
      
      <div class="submit">
        <input type="submit" value="Ajouter"/>
      </div>
    </div>
  </div>
</form>