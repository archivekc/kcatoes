<h1>Scenario&nbsp;: <strong><?php echo $scenario->getNom()?></strong></h1>
    <form method="post" action="<?php echo url_for('scenarioDetail', array('id'=>$scenario->getId()))?>" class="highlight <?php echo !$addPageForm->hasErrors()?'quickAddForm':'' ?>">
      <h2>Ajout d'un type de page</h2>
      <div>
        <div class="fields">
          <?php if ($addPageForm->hasGlobalErrors()):?>
          <div>
            <?php $addPageForm->renderGlobalErrors() ?>
          </div>
          <?php endif ?>
          <div>
            <?php echo $addPageForm->renderHiddenFields()?>
          </div>
          <div>
            <?php echo $addPageForm['nom']->renderError()?>
            <?php echo $addPageForm['nom']->renderLabel()?>
            <?php echo $addPageForm['nom']->render()?>
          </div>
          <div>
            <?php echo $addPageForm['required']->renderError()?>
            <?php echo $addPageForm['required']->renderLabel()?>
            <?php echo $addPageForm['required']->render()?>
          </div>
          <div>
            <?php echo $addPageForm['web_page_id']->renderError()?>
            <?php echo $addPageForm['web_page_id']->renderLabel()?>
            <?php echo $addPageForm['web_page_id']->render()?>
          </div>
        </div>
        <div class="submit">
          <input type="submit" value="Ajouter"/>
        </div>
      </div>
    </form>
<div>
  <?php $nbPages = count($pages) ?>
  <?php if ($nbPages == 0): ?>
      <p class="zeroFound">
        Aucune page trouvée
      </p>
  <?php else:?>
  <form method="post" action="<?php echo url_for('scenarioDetail', array('id'=>$scenario->getId()))?>">
    <div>
      <input type="hidden" name="templateId" value="<?php echo $scenario->getId() ?>"/>
      <?php echo $setAsTemplateForm['nom']->renderError()?>
      <?php echo $setAsTemplateForm['nom']->renderLabel()?>
      <?php echo $setAsTemplateForm['nom']->render()?>
    </div>
    <div class="submit">
      <input type="submit" value="Définir un modèle à partir de ce scénario"/>
    </div>
  </form>
  <table summary="Pages du scénario">
    <caption>Pages du scenario</caption>
    <thead>
      <tr>
        <th scope="col">Type de page</th>
        <th scope="col">Url</th>
        <th scope="col">Obligatoire</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
	    <?php foreach($pages as $page): ?>
	    <tr>
	      <td><?php echo $page->getNom() ?></td>
	      <td><?php echo $page->getWebPage()->getUrl() ?></td>
	      <td><?php echo $page->getRequired()?'oui':'non'?></td>
	      <td>
	        <?php echo link_to('Modifier', 'scenarioPageEdit'
	                       ,array('id'=>$page->getId())
	                       ,array('class'=> 'ico modifier'
	                       ,'title'=> 'Modifier la page '.$page->getNom())) 
	        ?>
		      <?php echo link_to('Supprimer', 'scenarioPageDelete'
		                     ,array('id'=>$page->getId())
		                     ,array('class'=> 'ico supprimer'
		                     ,'title'=> 'Supprimer le type de page '.$page->getNom())) 
		      ?>
		      <?php if(strlen($page->getWebPage()->getUrl()) > 0):?>
	          <?php echo link_to('Détail de la page', 'pageDetail'
	                         ,array('id'=>$page->getId())
	                         ,array('class'=> 'ico detail'
	                         ,'title'=> 'Voir la page '.$page->getNom())) 
	          ?>
          <?php endif; ?>
	      </td>
	    </tr>
	    <?php endforeach;?>
    
    </tbody>
  </table>
  <?php endif ?>
</div>
<a href="<?php echo url_for('scenarioIndex')?>">Liste des scenarii</a>