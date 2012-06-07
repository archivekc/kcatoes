<div class="block" id="scenarioTemplateIndex">
<h1>Modèles de scénarios</h1>
    <?php $nbScenario = count($scenarioTemplates)?>
    <?php if($nbScenario == 0):?>
      <p class="zeroFound">
        Aucun modèle de scénario trouvé.
      </p>
      <?php if ($sf_user->hasCredential('gestion scenario')):?>
      <p class="zeroFound">
        Vous pouvez ajouter des modèles en dupliquant un scénario sur sa page de détail
      </p>
      <?php endif ?>
    <?php else: ?>
      <ul class="listItem" id="scenarioList">
			<?php foreach($scenarioTemplates as $template): ?>
			 <li class="highlight">
			   <h2 class="nom"><?php echo $template['nom']?></h2>
			   <?php if ($sf_user->hasCredential('gestion scenario')):?>
         <?php echo link_to('Supprimer', 'scenarioTemplateDelete'
                            ,array('id'=>$template['id'])
                            ,array('class'=> 'ico supprimer'
                                   ,'title'=> 'Supprimer le modèle de scénario '.$template['nom']
                                   ,'confirm'=>'Êtes-vous sûr ?')) 
         ?>
         <?php endif ?>
			   <?php $nbPage = count($template['CollectionPages'])?>
			   <?php if ($nbPage == 0):?>
			     Aucune page associée à ce modèle
			   <?php else:?>
			     <ul class="templatePage">
			       <?php foreach($template['CollectionPages'] as $page):?>
			         <li>
                  <?php if ($page['required']):?>
	                <?php echo image_tag('/img/ico/asterisk_orange.png',array(
	                        'title' => 'Page obligatoire'
	                        ,'alt' => 'Obligatoire'
	                        ,'class' => 'required')) ?>
	               <?php endif ?>
			           <?php echo $page['nom'] ?>
			         </li>
			       <?php endforeach;?>
			     </ul>
			   <?php endif ?>
			 </li>
			<?php endforeach ?>
			</ul>
		<?php endif ?>
</div>