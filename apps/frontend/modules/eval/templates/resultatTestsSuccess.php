
<ul>
<?php foreach($extraction->getCollectionResults() as $result): ?>
  <li>
    <div class="testClass">
      <?php $t_class = $result->getClass() ?>
      <?php echo $t_class::getIdLibelle() ?>
    </div>
    
    Procédure : 
    <ul class="testProc">
      <?php $proc = $t_class::getProc() ?>
      <?php foreach ($proc as $p): ?>
        <li>
          <?php echo $p ?>
        </li>
      <?php endforeach; ?>
    </ul>
    
    Références :
    <ul class="testDocLinks">
      <?php $docs = $t_class::getDocLinks() ?>
      <?php foreach ($docs as $ref => $doc): ?>
        <li>
          <?php echo link_to($ref, $doc); ?>
        </li>
      <?php endforeach; ?>
    </ul>
    
    <div class="testResult">
      Résultat : 
      <span class="testResultValue">
        <?php echo Resultat::getLabel($result->getResult()) ?>        
      </span>
    </div>
    
    <div class="testResultDetail">
      Détail : 
      <ul>
        <?php foreach($result->getCollectionLines() as $line): ?>
          <li> 
            <span class="testResult">
              <?php echo Resultat::getLabel($line->getResult()) ?>
            </span>
        
            <div>
              Commentaire : <?php echo $line->getComment() ?><br />
              XPath : <?php echo $line->getXpath() ?><br />
              CSS selector : <?php echo $line->getCssSelector() ?><br />
              Source : <pre><?php echo $line->getSource() ?></pre>

            </div>
            
          </li>
        <?php endforeach;?>
      </ul>
    </div>
    
    
  </li>
<?php endforeach; ?>
</ul>

<?php echo link_to('Retour', 'pageDetail', array('id' => $page->getId())) ?>