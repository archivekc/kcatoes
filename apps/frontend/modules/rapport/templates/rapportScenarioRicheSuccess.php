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

          <?php /* Filtrage par ID d'extraction sélectionnés  */ ?>
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


            <?php /* Rapport global */ ?>
            <?php include_partial('rapport', array( 'titre' => 'Total',
                                                    'totaux' => $rapport['total'])) ?>

            <?php /* Rapport par thématique */ ?>

            <?php foreach($rapport['thematiques'] as $thematique => $rapportThematique): ?>
              <?php include_partial('rapport', array( 'titre' => 'Thématique : '.$thematique,
                                                      'totaux' => $rapportThematique)) ?>
            <?php endforeach;?>

          <?php endif; ?>

        </li>
      <?php endforeach; ?>

    </ul>

  <?php endforeach; ?>

</div>