
<ul>
<?php foreach($extraction->getCollectionResults() as $result): ?>
  <li>
    <span class="testClass">
      <?php $t_class = $result->getClass() ?>
      <?php echo $t_class::getIdLibelle() ?>
    </span>
    <span class="testResult">
      <?php echo Resultat::getLabel($result->getResult()) ?>
    </span>
    
    
    <ul>
      <?php foreach($result->getCollectionLines() as $line): ?>
        <li> line : 
          <span class="testResult">
            <?php echo Resultat::getLabel($line->getResult()) ?>
          </span>
        </li>
      <?php endforeach;?>
    </ul>
  </li>
<?php endforeach; ?>
</ul>

<?php echo link_to('Retour', 'pageDetail', array('id' => $page->getId())) ?>