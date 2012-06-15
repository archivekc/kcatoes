<?php use_helper('Ihm') ?>

<?php if (count($results) > 0):?>

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
  </ul>

<?php else: ?>

  <?php if (count($results) == 0):?>
    <div class="rapportVide">
      <?php if (count($userTests) == 0): ?>
        <p>
          Vous n'avez aucun test associé à votre profil.
        </p>
        <p>
          Vous pouvez:
          <ul class="normal">
            <li>demander à votre administrateur de vous associer un profil de test</li>
            <li>ajouter vous-même des tests dans vos <a href="<?php echo url_for('userTest') ?>">paramètres utilisateur</a></li>
          </ul>
        </p>
      <?php else: ?>
        <p>
          Pas de résultats pour ce filtre et/ou pour les tests associés à votre profil.
        </p>
      <?php endif; ?>
    </div>
  <?php endif; ?>

<?php endif; ?>













  





