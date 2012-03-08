<h1><span>Pages web</span></h1>
<form method="post" action="<?php echo url_for('ihm/WebPages')?>" class="highlight">
  <h2>Ajout d'une page web</h2>
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
	    <?php echo $addPageForm['url']->renderError()?>
			<?php echo $addPageForm['url']->renderLabel()?>&nbsp;:
			<?php echo $addPageForm['url']->render()?><br/>
	  </div>
	  <div>
	    <?php echo $addPageForm['description']->renderError()?>
	    <?php echo $addPageForm['description']->renderLabel()?>&nbsp;:
	    <?php echo $addPageForm['description']->render()?><br/>
	  </div>
	</div>
	<div class="submit">
    <button type="submit">Ajouter</button>
	</div>
</form>
<?php if (count($pages)): ?>
<ul class="accessList">
  <?php foreach($pages as $page):?>
  <li>
    <?php // url ?>
    <?php echo link_to($page->getUrl(), 'webPage',
                        array('id'=>$page->getId())
                        ,array('class' => 'item'))?>
    <?php $count = count($page->getCollectionTestConfig())?>
    [<?php echo $count?> configuration(s)] 
    <?php // actions ?>
    <?php if($count== 0):?>
      <span class="actions">

        <?php echo link_to('Supprimer', 'deleteWebPage',
                            array('id'=>$page->getId())
                            ,array('class'=> 'ico supprimer'
                                  ,'title'=> 'Supprimer la page '.$page['url'])) 
         ?>

      </span>
    <?php endif ?>
    
    <?php // description ?>
    <?php if (strlen(trim($page->getDescription()))):?>
      <p class="description"><?php echo $page->getDescription()?></p>
    <?php endif ?>
  </li>
  <?php endforeach; ?>
</ul>
<?php else: ?>
	<p class="zeroFound">Aucune page n'est renseignée</p>
<?php endif; ?>
