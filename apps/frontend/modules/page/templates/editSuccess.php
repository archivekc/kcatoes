    <form method="post"  id="editPageForm" class="block" action="<?php echo url_for('pageEdit'
                                                    ,array('id'=>$page->getId()))?>"
          class="highlight">
      <h1>Modification de la page&nbsp;: <strong><?php echo $page->getUrl()?></strong></h1>
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
            <?php echo $editPageForm['url']->renderLabel()?>
            <?php echo $editPageForm['url']->render(array('readonly'=>'readonly'))?>
          </div>
          <div>
            <?php echo $editPageForm['description']->renderError()?>
            <?php echo $editPageForm['description']->renderLabel()?>
            <?php echo $editPageForm['description']->render()?>
          </div>
	        <div class="submit">
	          <input type="submit" value="Modifier"/>
	        </div>
        </div>
      </div>
    </form>