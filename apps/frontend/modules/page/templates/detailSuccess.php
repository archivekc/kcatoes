<h1>Page&nbsp;: <strong><?php echo $page->getUrl()?></strong></h1>
<?php if (strlen($page->getDescription()) > 0):?>
  <p class="description">
    <?php $page->getDescription() ?>
  </p>
<?php endif ?>
<div class="twoParts">
  <div class="part">
    <h2>Extractions</h2>
    <?php $nbExtracts = count($page->getCollectionExtracts())?>
    <?php if ($nbExtracts == 0):?>
    <p class="zeroFound">Aucune extraction</p>
    <?php else:?>
      liste des extractions
    <?php endif ?>
  </div>
  <div class="part">
    <h2>Tests</h2>
  </div>
</div>