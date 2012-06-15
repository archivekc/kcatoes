<?php use_helper('Ihm')?>
<div class="block" id="scenarioDetail">
  <h1>Scénario&nbsp;: <strong><?php echo $scenario->getNom()?></strong></h1>
  <div class="topAction">
  <?php if ($sf_user->hasCredential('gestion scenario')):?>
      <span>Ajout d'un type de page</span>
      <form method="post" id="scenarioAddPageForm" action="<?php echo url_for('scenarioDetail', array('id'=>$scenario->getId()))?>" class="block <?php echo !$scenarioPageForm->hasErrors()?'quickAddForm':'' ?>">
        <h2>Ajout d'un type de page</h2>
        <div>
          <div class="fields">
            <?php if ($scenarioPageForm->hasGlobalErrors()):?>
            <div>
              <?php $scenarioPageForm->renderGlobalErrors() ?>
            </div>
            <?php endif ?>
            <div>
              <?php echo $scenarioPageForm->renderHiddenFields()?>
            </div>
            <div>
              <?php echo $scenarioPageForm['nom']->renderError()?>
              <?php echo $scenarioPageForm['nom']->renderLabel()?>
              <?php echo $scenarioPageForm['nom']->render()?>
            </div>
            <div>
              <?php echo $scenarioPageForm['required']->renderError()?>
              <?php echo $scenarioPageForm['required']->renderLabel()?>
              <?php echo $scenarioPageForm['required']->render()?>
            </div>
            <div>
              <?php echo $scenarioPageForm['web_page_id']->renderError()?>
              <?php echo $scenarioPageForm['web_page_id']->renderLabel()?>
              <?php echo $scenarioPageForm['web_page_id']->render()?>
            </div>
            
            <div>
              Ou ajouter une nouvelle page : 
            </div>
              
            <div class="subForm">
              <?php $webPageForm = $scenarioPageForm['newWebPage']; ?>
              <div>
                <?php echo $webPageForm['url']->renderError()?>
                <?php echo $webPageForm['url']->renderLabel()?>
                <?php echo $webPageForm['url']->render()?>
              </div>
              <div>
                <?php echo $webPageForm['src']->renderError()?>
                <?php echo $webPageForm['src']->renderLabel()?>
                <?php echo $webPageForm['src']->render()?>
              </div>
              <div>
                <?php echo $webPageForm['description']->renderError()?>
                <?php echo $webPageForm['description']->renderLabel()?>
                <?php echo $webPageForm['description']->render()?>
              </div>
            </div>
            
            <div class="submit">
              <input type="submit" value="Ajouter"/>
            </div>
          </div>
        </div>
      </form>

    <?php endif ?>
    
    <?php $nbPages = count($pages) ?>
    <?php if ($nbPages == 0): ?>
        <p class="zeroFound">
          Aucune page trouvée
        </p>
    <?php else:?>
    <?php if ($sf_user->hasCredential('gestion scenario')):?>
    <form method="post" id="setAsTemplateScenarioForm" class="highlight" action="<?php echo url_for('scenarioDetail', array('id'=>$scenario->getId()))?>">
      <h2>Définir un modèle à partir de ce scénario</h2>
      <div>
        <input type="hidden" name="templateId" value="<?php echo $scenario->getId() ?>"/>
        <?php echo $setAsTemplateForm['nom']->renderError()?>
        <?php echo $setAsTemplateForm['nom']->renderLabel()?>
        <?php echo $setAsTemplateForm['nom']->render()?>
        <input type="submit" value="Définir"/>
      </div>
    </form>
    <?php endif?>
  </div>
    <h2>Pages du scenario</h2>

    <?php if ($sf_user->hasFlash('testsMsg')): ?>
      <?php echo userMsg($sf_user->getFlash('testsMsg'), 'success') ?> 
    <?php endif; ?>
    
    <form method="post" action="<?php echo url_for('scenarioActions', array('id'=>$scenario->getId()))?>">
      <ul class="scenarioPages">
      <?php foreach($pages as $page): ?>
        <?php 
          $hasWebpage = count($page->getWebPage())>0;
        ?>
        <li class="highlight">
          <div class="headPage">
  	        <h3>
  	          <?php if ($page->getRequired()):?>
  	            <?php echo image_tag('/img/ico/asterisk_orange.png',array(
  	                    'title' => 'Page obligatoire'
  	                    ,'alt' => 'Obligatoire'
  	                    ,'class' => 'required')) ?>
  	          <?php endif ?>
  	          <?php echo $page->getNom() ?>
  	        </h3>
  	        <?php if ($sf_user->hasCredential('gestion scenario')):?>
  	        <div class="actions">
  	           <?php echo link_to('Modifier', 'scenarioPageEdit'
  	                           ,array('id'=>$page->getId())
  	                           ,array('class'=> 'ico modifier popupScreen'
  	                           ,'title'=> 'Modifier la page '.$page->getNom())) 
  	            ?>
  	            <?php echo link_to('Supprimer', 'scenarioPageDelete'
  	                           ,array('id'=>$page->getId(), 'scenarioId'=>$scenario->getId())
  	                           ,array('class'=> 'ico supprimer'
  	                           ,'title'=> 'Supprimer le type de page '.$page->getNom())) 
  	            ?>
  	        </div>
  	        <?php endif ?>
          </div>
          <?php if ($hasWebpage):?>
          <div class="twoParts">
          
  	        <div class="summaryPage part smallpart">
  	          <div class="url"><?php echo $page->getWebPage()->getUrl() ?></div>
              <?php if (strlen(trim($page->getWebPage()->getDescription()))>0):?>
  	           <div class="description"><?php echo $page->getWebPage()->getDescription() ?></div>
              <?php endif ?>
  	        </div>
  	        
  	        <?php $extracts = $page->getWebPage()->getCollectionExtracts()?>
  	        <?php if (count($extracts)>0):?>
  	          <div class="scenarioPageExtractList part bigpart">
  	            <div class="actions">
  		            <?php echo link_to('Gérer les extractions', 'pageExtracts'
  		                              ,array('id'=>$page->getWebPage()->getId())
  		                              ,array('class'=> 'ico extraire'
  		                                    ,'title'=> 'Gérer les extractions de la page '.$page->getWebPage()->getUrl())) 
  		            ?>
  		          </div>
  	            <ul>
  	            <?php foreach ($extracts as $extract):?>
  	              <?php
  	                $testPassed = count($extract->getCollectionResults());
  	              ?>
  	               <li class="extract <?php echo $testPassed?'':'nbTest0'?>">
  	                  <input type="checkbox" name="extracts[]" id="extr_<?php echo $extract->getId()?>" checked="checked" value="<?php echo $extract->getId()?>"/>
  	                  <label for="extr_<?php echo $extract->getId()?>">
  	                    <span class="type"><?php echo $extract->getType()?></span>
  	                    <span class="nbTest"><?php echo $testPassed ?> test(s) passé(s)</span>
  	                  </label>
  	                  <?php if ($testPassed>0):?>
  	                  <?php echo link_to('Fiche d\'évaluation', 'evaluation', 
                                array('id' => $extract->getId()), 
                                array('class' => 'evalLink', 'popup'=>true)) ?>
                      <?php endif ?>
  	               </li>
  	             <?php endforeach ?>
  	             </ul>
  	           </div>
  	          <?php endif ?>
            </div>
          <?php else: ?>
            <?php if ($page->getRequired()):?>
              <?php echo userMsg('Aucune page associée. Celle-ci est obligatoire', 'warning')?>
            <?php else: ?>
              <p>Aucune page associée</p>
            <?php endif;?>
          <?php endif ?>
        </li>
      <?php endforeach ?>
      </ul>
      
      <div id="scenarioDetailActions">
      
        <?php if (!$testsRunning):?>
          
  	      <h2 class="title">Actions sur le scenario</h2>
  	      <div class="highlight">
  		  	  <?php echo userMsg('Les actions ci-dessous seront faites sur les extractions sélectionnées.', 'info')?>
  		  	  <div class="submit">
  		  	  <!--[if !IE]> -->
  		  	    <button type="submit" name="scenarioAction" value="rapport_detaille">Rapport détaillé</button>
  		  	    <button type="submit" name="scenarioAction" value="rapport_simple">Rapport simple</button>
  		  	    <button type="submit" name="scenarioAction" value="execute_tests">Lancer les tests</button>
  		  	  <!-- <![endif]-->
            <!--[if IE]> 
              <input type="submit" name="scenarioAction" value="rapport_detaille"/>
              <input type="submit" name="scenarioAction" value="rapport_simple"/>
              <input type="submit" name="scenarioAction" value="execute_tests"/>
            <![endif]-->
  		  	  </div>
  		  	</div>
        
        <?php else:?>
          	<iframe id="avancementScenario" src="<?php echo url_for('scenarioAvancement', array('id'=>$scenario->getId()))?>">
          	</iframe>
            
            <div class="submit">
            <!--[if !IE]> -->
              <button type="submit" name="scenarioAction" value="annule_tests">Annuler l'exécution</button>
            <!-- <![endif]-->
            <!--[if IE]> 
              <input type="submit" name="scenarioAction" value="annule_tests"/>
            <![endif]-->
            </div>
            
            
            
        <?php endif?>
        
  	  </div>
    </form>
    <?php endif ?>

  <a class="ico liste" href="<?php echo url_for('scenarioIndex')?>">Retour à la liste des scenarii</a>
</div>