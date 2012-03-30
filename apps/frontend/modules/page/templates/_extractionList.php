  <?php $nbExtracts = count($page->getCollectionExtracts())?>
  <?php if ($nbExtracts == 0):?>
  <p class="zeroFound">Aucune extraction</p>
  <?php else:?>
    <ul>
    <?php foreach($page->getCollectionExtracts() as $extract): ?>
      <li>
        <?php echo $extract->getType() ?>
        <?php if (count($extract->getCollectionResults()) > 0): ?>
          <?php echo link_to('Relancer les tests', 'pageExecuteTests', array('id' => $extract->getId())) ?>
          <?php echo link_to('Voir les résultats', 'pageResultatTests', array('id' => $extract->getId())) ?>
        <?php else: ?>
          <?php echo link_to('Lancer les tests', 'pageExecuteTests', array('id' => $extract->getId())) ?>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
    </ul>
  <?php endif ?>