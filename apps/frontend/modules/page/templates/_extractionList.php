  <?php $nbExtracts = count($page->getCollectionExtracts())?>
  <?php if ($nbExtracts == 0):?>
  <p class="zeroFound">Aucune extraction</p>
  <?php else:?>
    <ul>
    <?php foreach($page->getCollectionExtracts() as $extract): ?>
      <li>
        <?php echo $extract->getType() ?>
        
        <?php echo link_to('Lancer les tests', 'pageExecuteTests', array('id' => $extract->getId())) ?>
      </li>
    <?php endforeach; ?>
    </ul>
  <?php endif ?>