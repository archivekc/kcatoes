<h1><span>Page&nbsp;: <?php echo $page->getUrl() ?></span></h1>
<p class="description">
  <?php echo $page->getDescription()?>
</p>

<?php 
      // *** Formulaire d'ajout de configuration de test
?>

<form method="post" action="<?php echo url_for('webPage', array('id'=>$page->getId()))?>">
  <div>
    <?php $addConfigForm->renderGlobalErrors() ?>
  </div>
  <div>
    <?php echo $addConfigForm->renderHiddenFields()?>
  </div>
  <div>
    <?php echo $addConfigForm['test_config_id']->renderError()?>
    <?php echo $addConfigForm['test_config_id']->renderLabel()?>&nbsp;:
    <?php echo $addConfigForm['test_config_id']->render()?>

    <input type="submit" value="Ajouter"/>
  </div>
</form>

<?php 
      // *** Affichage des configurations de test déjà liées 
?>

<?php  if (count($configs)): ?>
<ul>
  <?php foreach($configs as $config):?>
  <li>
    <?php echo $config->getLibelle(); ?> - 
    <a href="" class="url"><?php //echo $eval->getConfig()->getLibelle()?></a>
    
    <?php echo link_to('Lancer', 'launchTests', 
                                        array('web_page_id' => $page->getId(), 
                                              'test_config_id' => $config->getId())) ?>
                                              
    <?php echo link_to('Supprimer', 'webPageDeleteConfigTest', 
                                        array('web_page_id' => $page->getId(), 
                                              'test_config_id' => $config->getId())) ?>
                                              
  </li>
  <?php endforeach; ?>
</ul>
<?php else: ?>
  Aucune évaluation trouvée
<?php endif; ?>






