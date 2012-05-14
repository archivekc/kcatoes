<div class="twoParts">
  <?php // pages web ?>
  <div class="part">
		<h1><span>Pages web</span></h1>
		<form method="post" action="<?php echo url_for('ihm/index')?>" class="highlight quickAddForm">
		  <h2>Ajout d'une page web</h2>
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
			    <input type="submit" value="Ajouter"/>
			  </div>
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
		    <?php $countConfig = count($page->getCollectionTestConfig())?>
		    [<?php echo $countConfig?> configuration(s)]
		    
		    <?php $countExtract = count($page->getCollectionExtracts())?>
        [<?php echo $countExtract?> Extraction(s)]  
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
  </div>
  
  <?php // configurations de test ?>
  <div class="part">
		<h1><span>Configurations de test</span></h1>
		<form method="post" action="<?php echo url_for('ihm/index')?>" class="highlight quickAddForm">
		  <h2>Ajout d'une configuration de test</h2>
		  <div>
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
			    <input type="submit" value="Ajouter"/>
			  </div>
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
  </div>
</div>









