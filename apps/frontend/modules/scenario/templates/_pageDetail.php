<?php $hasWebpage = count($page->getWebPage())>0; ?>
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
              $type = $extract->getType();
              $checked = ($type == 'base') ? 'checked="checked"' : '';
            ?>
            <li class="extract <?php echo $testPassed?'':'nbTest0'?>">
              <input type="checkbox" name="extracts[]" id="extr_<?php echo $extract->getId()?>" <?php echo $checked ?> value="<?php echo $extract->getId()?>"/>
              <label for="extr_<?php echo $extract->getId()?>">
                <span class="type"><?php echo $type ?></span>
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