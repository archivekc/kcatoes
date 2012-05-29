<?php use_helper('Ihm')?>
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
  <form method="post" action="<?php echo url_for('scenarioActions', array('id'=>$scenario->getId()))?>">
	  <table summary="Pages du scénario">
	    <caption>Pages du scenario</caption>
	    <thead>
	      <tr>
	        <th scope="col">Type de page</th>
	        <th scope="col">Url</th>
	        <th scope="col">Extractions</th>
	        <th scope="col">Obligatoire</th>
	        <th scope="col">Actions</th>
	      </tr>
	    </thead>
	    <tbody>
		    <?php foreach($pages as $page): ?>
		    <?php 
		     $hasWebpage = count($page->getWebPage())>0;
		     ?>
		    <tr>
		      <td><?php echo $page->getNom() ?></td>
		      <?php if ($hasWebpage):?>
		      <td><?php echo $page->getWebPage()->getUrl() ?></td>
		      <td>
		         <?php $extracts = $page->getWebPage()->getCollectionExtracts()?>
		         <?php if (count($extracts)>0):?>
		           <ul class="scenarioPageExtractList">
			         <?php foreach ($extracts as $extract):?>
			           <?php
			             $testPassed = count($extract->getCollectionResults());
			           ?>
			            <li class="extract <?php echo $testPassed?'':'nbTest0'?>">
			               <input type="checkbox" name="extracts[]" id="extr_<?php echo $extract->getId()?>" checked="checked" value="<?php echo $extract->getId()?>"/>
			               <label for="extr_<?php echo $extract->getId()?>">
			                 <span class="type"><?php echo $extract->getType()?></span>
			                 &mdash;
			                 <span class="nbTest"><?php echo $testPassed ?> test(s) passé(s)</span>
			               </label>
			            </li>
			         <?php endforeach ?>
			         </ul>
		         <?php endif ?>
		      </td>
		      <?php else: ?>
		      <td></td>
		      <td></td>
		      <?php endif ?>
		      
		      <td><?php echo $page->getRequired()?'oui':'non' ?></td>
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
			      <?php if($hasWebpage):?>
		          <?php echo link_to('Détail de la page', 'pageDetail'
		                         ,array('id'=>$page->getWebPage()->getId())
		                         ,array('class'=> 'ico detail'
		                         ,'title'=> 'Voir la page '.$page->getNom())) 
		          ?>
	          <?php endif; ?>
		      </td>
		    </tr>
		    <?php endforeach;?>
	    
	    </tbody>
	  </table>
	  <?php echo userMsg('Les actions ci-dessous seront faites sur les extractions sélectionnées.', 'info')?>
	  <div class="submit">
	    <button type="submit" name="scenarioAction" value="rapport_detaille">Rapport détaillé</button>
	    <button type="submit" name="scenarioAction" value="rapport_simple">Rapport simple</button>
	    <button type="submit" name="scenarioAction" value="execute_test">Lancer les tests</button>
	  </div>
  </form>
  <?php endif ?>
</div>
<a href="<?php echo url_for('scenarioIndex')?>">Liste des scenarii</a>