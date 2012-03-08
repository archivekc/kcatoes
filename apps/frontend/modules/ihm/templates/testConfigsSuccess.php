<h1><span>Configurations de test</span></h1>
<form method="post" action="<?php echo url_for('ihm/TestConfigs')?>" class="highlight">
  <div class="fields">
	  <?php if ($addTestConfigForm->hasGlobalErrors()):?>
	  <div>
	    <?php $addTestConfigForm->renderGlobalErrors() ?>
	  </div>
	  <?php endif ?>
	  <div>
	    <?php echo $addTestConfigForm->renderHiddenFields()?>
	    <?php echo $addTestConfigForm['libelle']->renderError()?>
			<?php echo $addTestConfigForm['libelle']->renderLabel()?>&nbsp;:
			<?php echo $addTestConfigForm['libelle']->render()?><br/>
	  </div>
	  <div>
	    <?php echo $addTestConfigForm['description']->renderError()?>
	    <?php echo $addTestConfigForm['description']->renderLabel()?>&nbsp;:
	    <?php echo $addTestConfigForm['description']->render()?><br/>
	  </div>
  </div>
	<div class="submit">
    <button type="submit">Ajouter</button>
	</div>
</form>
<?php if (count($configs)): ?>
<ul class="accessList">
  <?php foreach($configs as $config):?>
  <li>
    <?php // url ?>
    <?php $countTest = count($config->getCollectionTests())?>
    <?php $countPage = count($config->getCollectionWebPage())?>
    <?php echo link_to($config->getLibelle(), 'testConfig',
                        array('id'=>$config->getId())
                        ,array('class' => 'item'))?>
    [<?php echo $countTest?> test(s)]
    [<?php echo $countPage?> page(s)]
    
    <?php // actions ?>
    <?php if($countTest == 0 && $countPage == 0):?>
      <span class="actions">

        <?php echo link_to('Supprimer', 'deleteTestConfig',
                            array('id'=>$config->getId())
                            ,array('class'=> 'ico supprimer'
                                  ,'title'=> 'Supprimer la configuration '.$config->getLibelle())) 
         ?>

      </span>
    <?php endif ?>
    <?php // description ?>
    <?php if (strlen(trim($config->getDescription()))):?>
      <p class="description"><?php echo $config->getDescription()?></p>
    <?php endif ?>
  </li>
  <?php endforeach; ?>
</ul>
<?php else: ?>
  <p class="zeroFound">Aucune configuration n'est renseignée</p>
<?php endif; ?>