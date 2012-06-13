<?php use_helper('Ihm') ?>

      <ul id="kcatoesRapport">
      <?php foreach($results as $result): ?>
      
        <?php $test = $result['class'] ?>
        <?php $nbLigne = count($result['CollectionLines']) ?>
        <?php $rowspan = ($nbLigne <=1 ) ? '' : 'rowspan="'.$nbLigne.'"' ?>
            
        <?php include_partial('testResultLine', array(
                                                    'test'    => $test
                                                  , 'nbLigne' => $nbLigne
                                                  , 'rowspan' => $rowspan
                                                  , 'result'  => $result
                                                  , 'history' => $history
        )) ?>
      <?php endforeach; ?>
      
      <?php if (count($results) == 0): ?>
      
        <p>
          Pas de résultats
        </p>
        
      <?php endif; ?>
      
      
      </ul>
