<h1>Page&nbsp;: <strong><?php echo $page->getUrl() ?></strong></h1>
<p class="description">
  <?php echo $page->getDescription()?>
</p>

<?php 
      // *** Formulaire d'ajout de configuration de test
?>
<?php if ($addConfigForm->getNbConfigs()>0):?>
<form method="post" action="<?php echo url_for('webPage', array('id'=>$page->getId()))?>" class="highlight quickAddForm">
  <h2>Ajout d'une configuration de test</h2>
  <div> 
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
  </div>
</form>
<?php endif ?>

<?php 
      // *** Affichage des configurations de test déjà liées 
?>

<?php  if (count($configs)): ?>
<ul class="accessList">
  <?php foreach($configs as $config):?>
  <?php $dir = $outputDir.DIRECTORY_SEPARATOR.$page->getId().'-'.$config->getId() ?>
  <?php $isTested = is_dir($dir) ?>
  <li>
    <span class="item"><?php echo $config->getLibelle(); ?></span> 
    <span class="actions">
    <?php if(!$isTested): ?>
	    <?php echo link_to('Lancer', 'launchTests', 
	                        array('web_page_id' => $page->getId()
	                              ,'test_config_id' => $config->getId())
	                        ,array('class'=>'ico lancer'
	                              ,'title'=>'Lancer l\'évaluation avec la configuration '.$config->getLibelle()
	                              )) ?>
	  <?php endif ?>
                                              
    <?php echo link_to('Supprimer', 'webPageDeleteConfigTest', 
                        array('web_page_id' => $page->getId() 
                              ,'test_config_id' => $config->getId())
                        ,array('class'=>'ico supprimer')) ?>
    </span>
    <?php if($isTested):?>
    <?php 
    $handle = opendir($dir);
    $mostRecentTime = 0;
    $mostRecentFile = null;
    while (false !== ($file = readdir($handle)))
    {
    	if ($file == '.' && $file == '..' && is_dir($dir.DIRECTORY_SEPARATOR.$file))
    	{
    	 continue;	
    	}
      if (preg_match('/output/', $file))
      {
      	$stat = stat($dir.DIRECTORY_SEPARATOR.$file);
      	if ($stat['mtime']>$mostRecentTime)
      	{
          $mostRecentTime = $stat['mtime'];
          $mostRecentFile = $file;
      	}
      }    	
    }
    $auto = false;
    clearstatcache(false, $dir.DIRECTORY_SEPARATOR.'auto_save.html');
    if (file_exists($dir.DIRECTORY_SEPARATOR.'auto_save.html'))
    {
    	$stat = stat($dir.DIRECTORY_SEPARATOR.'auto_save.html');
    	$auto = true;
    	$autoTime = $stat['mtime'];
    }
    ?>
      <ul>
        <li>
          Dernière sauvegarde utilisateur&nbsp;:
          <a target="_blank" href="/output/<?php echo $page->getId().'-'.$config->getId().'/'.$mostRecentFile ?>">
	          Voir les résultats - <?php echo date('d/m/Y H:i', $mostRecentTime)?>
	        </a>
        </li>
        <?php if ($auto):?>
        <li>
          Dernière sauvegarde automatique&nbsp;:
          <a href="/output/<?php echo $page->getId().'-'.$config->getId().'/' ?>auto_save.html">
            sauvegarde automatique - <?php echo date('d/m/Y H:i:s', $autoTime)?>
          </a>
        </li>
        <?php endif ?>
      </ul>
    <?php endif ?>
                       
  </li>
  <?php endforeach; ?>
</ul>
<?php else: ?>
  <p class="zeroFound">Aucune évaluation trouvée</p>
<?php endif; ?>






