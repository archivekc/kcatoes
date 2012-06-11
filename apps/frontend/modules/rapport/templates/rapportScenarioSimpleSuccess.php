<?php /* ?>

<?php $extractIds_raw = $extractIds->getRawValue(); ?>

<h1>rapport scénario simple</h1>

<div>
  <?php foreach($scenario->getScenarioPages() as $scenarioPage): ?>

    <?php $webPage = $scenarioPage->getWebPage(); ?>

    <h2>
      <strong>Page : <?php echo $scenarioPage->getNom() ?></strong><br />
      URL : <?php echo $webPage->getUrl() ?>
    </h2>

    <ul>
      <?php foreach($webPage->getCollectionExtracts() as $extract): ?>
        <li>

          <?php // Filtrage par ID d'extraction sélectionnés   ?>
          <?php if (count($extractIds_raw) == 0 || in_array($extract->getId(), $extractIds_raw)): ?>

            <h3>Extraction : <?php echo $extract->getType() ?></h3>
            <?php
              $results = $extract->getResults();
              $rapport = $extract->getRapport($results);
            ?>

            <?php if ($rapport['total']['total'] > 0):?>
            <?php echo link_to('Fiche d\'évaluation', 'pageResultatTestsRiche',
                                      array('id' => $extract->getId()),
                                      array('popup'=>true)) ?>
            <?php endif ?>

            <?php // Rapport global ?>
            <?php include_partial('rapport', array( 'titre' => 'Total',
                                                    'totaux' => $rapport['total'],
                                                    'extract' => $extract)) ?>

          <?php endif; ?>

        </li>
      <?php endforeach; ?>

    </ul>

  <?php endforeach; ?>

</div>

<?php */ ?>

<!-- 
HIGHLIGHT CELL with 0:

$('td').each(function(){
    if ($(this).text() == 0){
        $(this).text('').css('background', 'orange');
    }
});

 -->

<div class="block">
  <h1>Rapport de synthèse du scénario: <strong><?php echo $scenarioResult['TITLE']?></strong></h1>
  
  <h2>Global</h2>
    <table summary="Résultats globaux du scénario">
      <thead>
        <tr>
          <th scope="col">Niveau</th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::ECHEC)?></th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::ERREUR)?></th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::MANUEL)?></th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::NA)?></th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::NON_EXEC)?></th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::REUSSITE)?></th>
          <th scope="col">Indicateur</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($scenarioResult['GLOBAL'] as $niveau => $synthese):?>
          <tr>
             <th scope="row"><?php echo $niveau ?></th>
             <td><?php echo $synthese[Resultat::ECHEC]?></td>
             <td><?php echo $synthese[Resultat::ERREUR]?></td>
             <td><?php echo $synthese[Resultat::MANUEL]?></td>
             <td><?php echo $synthese[Resultat::NA]?></td>
             <td><?php echo $synthese[Resultat::NON_EXEC]?></td>
             <td><?php echo $synthese[Resultat::REUSSITE]?></td>
             <td>TODO</td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    
    
    
    
  <h2>Par thématique</h2>
  <?php foreach($scenarioResult['THEMATIQUE'] as $thematique => $result):?>
    <h3><?php echo $thematique?></h3>
        <table summary="Résultats globaux du scénario">
      <thead>
        <tr>
          <th scope="col">Niveau</th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::ECHEC)?></th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::ERREUR)?></th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::MANUEL)?></th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::NA)?></th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::NON_EXEC)?></th>
          <th scope="col"><?php echo Resultat::getLabel(Resultat::REUSSITE)?></th>
          <th scope="col">Indicateur</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($scenarioResult['THEMATIQUE'][$thematique] as $niveau => $synthese):?>
          <tr>
             <th scope="row"><?php echo $niveau ?></th>
             <td><?php echo $synthese[Resultat::ECHEC]?></td>
             <td><?php echo $synthese[Resultat::ERREUR]?></td>
             <td><?php echo $synthese[Resultat::MANUEL]?></td>
             <td><?php echo $synthese[Resultat::NA]?></td>
             <td><?php echo $synthese[Resultat::NON_EXEC]?></td>
             <td><?php echo $synthese[Resultat::REUSSITE]?></td>
             <td>TODO</td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endforeach ?>
</div>
