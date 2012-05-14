    <h1>Modification du scenario</h1>
    <form method="post" action="<?php echo url_for('scenarioEdit'
                                                  ,array('id'=>$scenario->getId()))?>"
          class="highlight">
      <h2>Modification d'un scenario de page web</h2>
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
            <?php echo $editScenarioForm['nom']->renderLabel()?>&nbsp;:
            <?php echo $editScenarioForm['nom']->render()?>
          </div>
        </div>
        <div class="submit">
          <input type="submit" value="Modifier"/>
        </div>
      </div>
    </form>