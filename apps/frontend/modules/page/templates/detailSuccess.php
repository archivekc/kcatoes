<?php use_helper('Partial') ?>
<h1>Page&nbsp;: <strong><?php echo $page->getUrl()?></strong></h1>
<?php if (strlen($page->getDescription()) > 0):?>
  <p class="description">
    <?php $page->getDescription() ?>
  </p>
<?php endif ?>
<div class="twoParts">
  <div class="part smallpart">
    <h2>Extractions</h2>
    <?php include_partial('extractionList', array('page' => $page )) ?>
  </div>
  <div class="part bigpart">
    <h2>Tests</h2>
    <?php include_partial('testsForm', array(   'page'      => $page
                                              , 'testsForm' => $testsForm
                                              , 'allTests'  => $allTests)) ?>
  </div>
</div>