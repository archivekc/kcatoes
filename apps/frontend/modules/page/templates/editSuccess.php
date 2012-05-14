    <h1>Modification de la page&nbsp;: <strong><?php echo $page->getUrl()?></strong></h1>
    <form method="post" action="<?php echo url_for('pageEdit'
                                                    ,array('id'=>$page->getId()))?>"
          class="highlight">
      <h2>Modification d'une page web</h2>
      <div>
        <div class="fields">
          <?php if ($editPageForm->hasGlobalErrors()):?>
          <div>
            <?php $editPageForm->renderGlobalErrors() ?>
          </div>
          <?php endif ?>
          <div>
            <?php echo $editPageForm->renderHiddenFields()?>
          </div>
          <div>
            <?php echo $editPageForm['url']->renderError()?>
            <?php echo $editPageForm['url']->renderLabel()?>&nbsp;:
            <?php echo $editPageForm['url']->render(array('readonly'=>'readonly'))?>
          </div>
          <div>
            <?php echo $editPageForm['description']->renderError()?>
            <?php echo $editPageForm['description']->renderLabel()?>&nbsp;:
            <?php echo $editPageForm['description']->render()?>
          </div>
        </div>
        <div class="submit">
          <input type="submit" value="Modifier"/>
        </div>
      </div>
    </form>