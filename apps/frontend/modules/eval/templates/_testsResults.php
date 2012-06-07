<?php use_helper('Ihm') ?>

<?php
  // Reprise de Tester::toRichHTML() ///////////////////////////////////////////////////////////////// 
?>

<?php if ($sf_user->hasFlash('success')): ?>
  <?php echo userMsg($sf_user->getFlash('success') , 'success', 'span', array('class' => 'saveMessage'));?>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <?php echo userMsg($sf_user->getFlash('error') , 'error', 'span', array('class' => 'saveMessage'));?>
<?php endif; ?>


<?php /*?>

    <table id="kcatoesRapport"><thead><tr>
      <th scope="col" class="testId">Id du test</th>
      <th scope="col" class="groups">Regroupement</th>
      <th scope="col" class="testInfo">Informations du test</th>
      <th scope="col" class="testStatus">Statut global</th>
      <th scope="col" class="subResult">Statut</th>
      <th scope="col" class="context">Contexte</th>
    </tr></thead><tbody>
<?php */ ?>
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
        
      <?php endforeach ?>
      </ul>
 <?php /*?>   
    </tbody></table>
  <?php */ ?>
