  <div class="block" id="scenarioIndex">
    <h1>Scenarii</h1>

  <span>Ajout d'un scenario de page web</span>
  <form method="post" id="addScenarioForm" action="<?php echo url_for('scenario/index')?>" class="block <?php echo !$addScenarioForm->hasErrors()?'quickAddForm':'' ?>">
      <h2>Ajout d'un scenario de page web</h2>
      <div>
        <div class="fields">
          <?php if ($addScenarioForm->hasGlobalErrors()):?>
          <div>
            <?php $addScenarioForm->renderGlobalErrors() ?>
          </div>
          <?php endif ?>
          <div>
            <?php echo $addScenarioForm->renderHiddenFields()?>
            <?php echo $addScenarioForm['nom']->renderError()?>
            <?php echo $addScenarioForm['nom']->renderLabel()?>
            <?php echo $addScenarioForm['nom']->render()?>
          </div>
          <div>
            <?php echo $addScenarioForm['template']->renderError()?>
            <?php echo $addScenarioForm['template']->renderLabel()?>
            <?php echo $addScenarioForm['template']->render()?>
          </div>
          <div class="submit">
            <input type="submit" value="Ajouter"/>
          </div>
        </div>
      </div>
    </form>


    <?php $nbScenario = count($scenarii)?>
    <?php if($nbScenario == 0):?>
      <p class="zeroFound">
        Aucun scenario trouvé
      </p>
    <?php else: ?>
    <ul class="listItem" id="scenarioList">
      <?php foreach($scenarii as $scenario):?>
        <li class="highlight">
          <h2>
            <span class="nom"><?php echo $scenario->getNom()?></span>
            &mdash; <?php echo count($scenario->getScenarioPages())?> page(s)
          </h2>
          <?php echo link_to('Détails', 'scenarioDetail'
                              ,array('id'=>$scenario->getId())
                              ,array('class'=> 'ico detail'
                                    ,'title'=> 'Voir le détails du scenario '.$scenario['nom'])) 
           ?>
          <?php echo link_to('Modifier', 'scenarioEdit'
                              ,array('id'=>$scenario->getId())
                              ,array('class'=> 'ico modifier popupScreen'
                                    ,'title'=> 'Modifier les informations du scenario '.$scenario['nom'])) 
          ?>
          <?php echo link_to('Supprimer', 'scenarioDelete'
                              ,array('id'=>$scenario->getId())
                              ,array('class'=> 'ico supprimer'
                                    ,'title'=> 'Supprimer le scenario '.$scenario['nom']
                                    ,'confirm'=>'Êtes-vous sûr ?')) 
           ?>
        </li>
    <?php endforeach ?>
    </ul>
    <?php endif ?>
  </div>