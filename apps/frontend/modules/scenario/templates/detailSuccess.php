<?php use_helper('Ihm')?>
<div class="block" id="scenarioDetail">
  <h1>Scénario&nbsp;: <strong><?php echo $scenario->getNom()?></strong></h1>
  <div class="topAction">
  
  <?php if ($sf_user->hasCredential('gestion scenario')):?>
    <?php include_partial('addPageForm', array('scenario' => $scenario, 'scenarioPageForm' => $scenarioPageForm )) ?>
  <?php endif ?>
    
  <?php $nbPages = count($pages) ?>
  <?php if ($nbPages == 0): ?>
      <p class="zeroFound"> Aucune page trouvée </p>
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
          <?php include_partial('pageDetail', array('scenario' => $scenario, 'page'=> $page)) ?>
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