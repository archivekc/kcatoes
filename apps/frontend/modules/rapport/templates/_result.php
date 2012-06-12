  <<?php echo $head?> class="title"><?php echo $title ?> (<strong><?php echo $resultData['NB_TEST'] ?></strong> tests)</<?php echo $head ?>>
  <div class="resultData">    
    <table summary="Résultats">
      <thead>
        <tr>
          <th scope="col">Niveau</th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::REUSSITE)?></th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::NA)?></th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::ECHEC)?></th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::MANUEL)?></th>
          <?php if ($showExecError):?>
            <th scope="col"><?php echo Resultat::getLabel(Resultat::ERREUR)?></th>
          <?php endif ?>
          <th scope="col"><abbr title="Conformité réglementaire">Conf. régl.</abbr></th>
          <th scope="col"><abbr title="Couverture de l'évaluation">Couv. eval.</abbr></th>
<!--          <th></th>-->
        </tr>
      </thead>
      <tbody>
        <?php foreach($resultData as $niveau => $synthese):?>
          <?php if ($niveau == 'NB_TEST') continue;?>
          <?php 
            $conformite = ($synthese['NB_APPLICABLE']==0)?'-':round(100* $synthese[Resultat::REUSSITE]/$synthese['NB_APPLICABLE'], PHP_ROUND_HALF_UP);
            $couverture = ($synthese['NB_TOTAL']==0)?'-':round(100* $synthese['NB_COUVERT']/$synthese['NB_TOTAL'], PHP_ROUND_HALF_UP);
          ?>
          <tr>
             <th scope="row"><?php echo $niveau ?></th>
             <td><?php echo $synthese[Resultat::REUSSITE]?></td>
             <td><?php echo $synthese[Resultat::NA]?></td>
             <td><?php echo $synthese[Resultat::ECHEC]?></td>
             <td><?php echo $synthese[Resultat::MANUEL]?></td>
             <?php if ($showExecError):?>
              <td><?php echo $synthese[Resultat::ERREUR]?></td>
             <?php endif ?>
             <td><?php echo $conformite ?> %</td>
             <td><?php echo $couverture ?> %</td>
             <!--<td>
              <ul>
                <li>APPLICABLE = <?php echo $synthese['NB_APPLICABLE']?></li>
                <li>NB_COUVERT = <?php echo $synthese['NB_COUVERT']?></li>
                <li>NB_TOTAL = <?php echo $synthese['NB_TOTAL']?></li>
              </ul>
             </td>
          --></tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>