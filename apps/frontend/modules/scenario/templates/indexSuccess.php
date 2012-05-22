    <h1>Scenarii</h1>
    <form method="post" action="<?php echo url_for('scenario/index')?>" class="highlight <?php echo !$addScenarioForm->hasErrors()?'quickAddForm':'' ?>">
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
        </div>
        <div class="submit">
          <input type="submit" value="Ajouter"/>
        </div>
      </div>
    </form>
    
    <?php $nbScenario = count($scenarii)?>
    <?php if($nbScenario == 0):?>
      <p class="zeroFound">
        Aucun scenario trouvé
      </p>
    <?php else: ?>
    <table summary="Liste des scenarii de pages web">
      <caption>Liste des scenarii de pages web</caption>
      <thead>
        <tr>
          <th scope="col">Nom</th>
          <th scope="col">Nombre de types de page</th>
          <th scope="col">Nombre de pages renseignées</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($scenarii as $scenario):?>
        <tr>
          <td><?php echo $scenario->getNom()?></td>
          <td><?php echo count($scenario->getScenarioPages())?></td>
          <td></td>
          <td>
              <?php echo link_to('Modifier', 'scenarioEdit'
                                  ,array('id'=>$scenario->getId())
                                  ,array('class'=> 'ico modifier'
                                        ,'title'=> 'Modifier les informations du scenario '.$scenario['nom'])) 
              ?>
              <?php echo link_to('Détails', 'scenarioDetail'
                                  ,array('id'=>$scenario->getId())
                                  ,array('class'=> 'ico detail'
                                        ,'title'=> 'Voir le détails du scenario '.$scenario['nom'])) 
               ?>


              <?php echo link_to('Supprimer', 'scenarioDelete'
                                  ,array('id'=>$scenario->getId())
                                  ,array('class'=> 'ico supprimer'
                                        ,'title'=> 'Supprimer le scenario '.$scenario['nom'])) 
               ?>
          </td>
        </tr>
      <?php endforeach ?>  
      </tbody>
    </table>
    <?php endif ?>