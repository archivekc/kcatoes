<?php use_helper('Partial') ?>
<?php use_helper('Ihm') ?>
<h1>Page&nbsp;: <strong><?php echo $page->getUrl()?></strong></h1>
<?php if (strlen($page->getDescription()) > 0):?>
  <p class="description">
    <?php echo $page->getDescription() ?>
  </p>
<?php endif ?>
<div class="twoParts">
  <div class="part smallpart">
    <h2>Extractions</h2>
    <?php echo link_to('Gérer les extractions', 'pageExtracts'
                                  ,array('id'=>$page->getId())
                                  ,array('class'=> 'ico extraire'
                                        ,'title'=> 'Gérer les extractions de la page '.$page['url'])) 
               ?>
    <?php include_partial('extractionList', array('page' => $page )) ?>
  </div>
  <div class="part bigpart">
    <?php include_partial('testsForm', array(   'page'      => $page
                                              , 'testsForm' => $testsForm
                                              , 'allTests'  => $allTests)) ?>
  </div>
</div>