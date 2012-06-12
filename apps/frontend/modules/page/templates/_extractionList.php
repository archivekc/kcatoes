  <?php $nbExtracts = count($page->getCollectionExtracts())?>
  <?php if ($nbExtracts == 0):?>
  <p class="zeroFound">Aucune extraction</p>
  <?php else:?>
    <ul>
    <?php foreach($page->getCollectionExtracts() as $extract): ?>
      <li>
        <?php echo $extract->getType() ?>
        (<?php echo $extract->getDateTimeObject('updated_at')->format('d/m/Y H:i:s'); ?>)
        
        <?php if (count($extract->getCollectionResults()) > 0): ?>
          <br /><?php echo link_to('Relancer les tests', 'pageExecutionTests', 
                              array('id' => $extract->getId())) ?>
          <br /><?php echo link_to('Voir les résultats', 'evaluationSimple', 
                              array('id' => $extract->getId())) ?>
                              
          <br /><?php echo link_to('Voir les résultats (riche)', 'evaluation', 
                              array('id' => $extract->getId()), 
                              array('popup'=>true)) ?>
                              
        <?php else: ?>
          <br /><?php echo link_to('Lancer les tests', 'pageExecutionTests', 
                             array('id' => $extract->getId())) ?>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
    </ul>
  <?php endif ?>