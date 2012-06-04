    <form method="post" id="editScenarioForm" action="<?php echo url_for('scenarioEdit'
                                                  ,array('id'=>$scenario->getId()))?>"
          class="block">
      <h1>Modification d'un scenario de page web</h1>
      <div>
        <div class="fields">
          <?php if ($editScenarioForm->hasGlobalErrors()):?>
          <div>
            <?php $editScenarioForm->renderGlobalErrors() ?>
          </div>
          <?php endif ?>
          <div>
            <?php echo $editScenarioForm->renderHiddenFields()?>
          </div>
          <div>
            <?php echo $editScenarioForm['nom']->renderError()?>
            <?php echo $editScenarioForm['nom']->renderLabel()?>
            <?php echo $editScenarioForm['nom']->render()?>
          </div>
          <div class="submit">
            <input type="submit" value="Modifier"/>
          </div>
        </div>
      </div>
    </form>

