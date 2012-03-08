<h1>Page&nbsp;: <strong><?php echo $page->getUrl() ?></strong></h1>
<p class="description">
  <?php echo $page->getDescription()?>
</p>

<?php 
      // *** Formulaire d'ajout de configuration de test
?>

<form method="post" action="<?php echo url_for('webPage', array('id'=>$page->getId()))?>" class="highlight">
  <h2>Ajout d'une configuration de test</h2>
  <div class="fields">
    <?php if ($addConfigForm->hasGlobalErrors()):?>
    <div>
      <?php $addConfigForm->renderGlobalErrors() ?>
    </div>
    <?php endif ?>
	  <div>
	    <?php echo $addConfigForm->renderHiddenFields()?>
	    <?php echo $addConfigForm['test_config_id']->renderError()?>
	    <?php echo $addConfigForm['test_config_id']->renderLabel()?>&nbsp;:
	    <?php echo $addConfigForm['test_config_id']->render()?>
	  </div>
  </div>
  <div class="submit">
    <input type="submit" value="Ajouter"/>
  </div>
</form>

<?php 
      // *** Affichage des configurations de test déjà liées 
?>

<?php  if (count($configs)): ?>
<ul class="accessList">
  <?php foreach($configs as $config):?>
  <li>
    <span class="item"><?php echo $config->getLibelle(); ?></span> 
    
    <?php echo link_to('Lancer', 'launchTests', 
                        array('web_page_id' => $page->getId()
                              ,'test_config_id' => $config->getId())
                        ,array('class'=>'ico lancer'
                              ,'title'=>'Lancer l\'évaluation avec la configuration '.$config->getLibelle()
                              )) ?>
                                              
    <?php echo link_to('Supprimer', 'webPageDeleteConfigTest', 
                        array('web_page_id' => $page->getId() 
                              ,'test_config_id' => $config->getId())
                        ,array('class'=>'ico supprimer')) ?>
                                              
  </li>
  <?php endforeach; ?>
</ul>
<?php else: ?>
  <p class="zeroFound">Aucune évaluation trouvée</p>
<?php endif; ?>






