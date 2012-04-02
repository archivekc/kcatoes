  <tr>
    <th <?php echo $sf_data->getRaw('rowspan') ?> class="testId"><?php echo $test::testId ?></th>
    <td <?php echo $sf_data->getRaw('rowspan') ?> class="groups"><?php echo Tester::arrayToHtmlList($test::getGroups()) ?></td>
    <td <?php echo $sf_data->getRaw('rowspan') ?> class="testInfo">
      <strong><?php echo $test::testName ?></strong>
      <div class="testProc"><strong>Procédure de test&nbsp;:</strong><?php echo Tester::arrayToHtmlList($test::getProc(), true) ?></div>
      <div class="testDoc"><strong>Documentation&nbsp;:</strong><?php echo Tester::arrayToHtmlList($test::getDocLinks(), true) ?></div>
    </td>
      
    <td <?php echo $sf_data->getRaw('rowspan') ?> class="testStatus"><?php echo Resultat::getLabel($result->getResult()) ?></td>
      
    <?php if ($nbLigne == 0): ?>
    
      <td colspan="2"></td></tr>
        
    <?php else: ?>

      <?php $first = true ?>
      <?php $cptLine = -1 ?>
      
      <?php foreach ($sf_data->getRaw('result')->getCollectionLines() as $resultLine): ?>
      
        <?php $cptLine++ ?>
        <?php if (!$first): ?>
          <tr>
        <?php endif ?>
        
        <?php $first = false ?>
        
        <td class="subResult"><?php echo Resultat::getLabel($resultLine->getResult()) ?></td>

        <td class="context">
        
          <?php $comment = '' ?>
          <?php if (strlen($resultLine->getComment())): ?>
            <?php 
              $comment = '<li class="comment"><strong>Retour du test&nbsp;:</strong> '.
                           '<div class="value">'.$resultLine->getComment().'</div></li>';
            ?>
          <?php endif ?>
          
          <?php $source = '' ?>
          <?php if (strlen($resultLine->getSource())): ?>
            <?php 
              $geshi = new GeSHi($resultLine->getSource(), 'html4strict');
              // conf geshi
              $geshi->set_header_type(GESHI_HEADER_DIV);
              $geshi->enable_line_numbers(GESHI_NO_LINE_NUMBERS);
              $geshi->enable_classes(false);
              $geshi->set_overall_class('htmlSource');
              $geshi->set_tab_width(4);
              $geshi->enable_keyword_links(false);
              
              $source = '<li class="source"><strong>Source&nbsp;:</strong> '.
                          '<div class="value">'.$geshi->parse_code().'</div></li>';
            ?>              
          <?php endif ?>
          
          <?php $css = '' ?>
          <?php if (strlen($resultLine->getCssSelector())): ?>
            <?php 
              $css = '<li class="cssSelector"><strong>Sélecteur CSS&nbsp;:</strong> '.
                       '<div class="value"><pre>'.$resultLine->getCssSelector().'</pre></div></li>';
            ?>
          <?php endif ?>
          
          <?php $context = $comment.$source.$css; ?>
          
          <?php if (strlen(trim($context)) > 0): ?>
            <ul><?php echo $context ?></ul>
          <?php endif ?>
           
        </td>
        </tr>

      <?php endforeach ?>
      
    <?php endif ?>