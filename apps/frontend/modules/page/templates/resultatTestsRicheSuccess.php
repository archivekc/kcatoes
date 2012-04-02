<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title><?php echo $title ?></title>
     
    <link rel="stylesheet" type="text/css" href="/kcatoesOutput/css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="/kcatoesOutput/css/rich.css"/>
    
    <script type="text/javascript" src="/kcatoesOutput/js/jquery-1.7.1-min.js"></script>
    <script type="text/javascript" src="/kcatoesOutput/js/rich.js"></script>
    
  </head>
  <body>
    <h1 id="rapportTitle">
      <img alt="" src="./kcatoesOutput/img/kcatoes.png"/>
      <?php echo $title ?>
      <?php echo $subtitle ?>
      <span class="score">Score&nbsp;<span class="scoreValue"><?php echo $score ?></span>%</span>
    </h1>
    <div id="output">
      <div class="inner">
      
        <table id="kcatoesRapport"><thead><tr>
          <th scope="col" class="testId">Id du test</th>
          <th scope="col" class="groups">Regroupement</th>
          <th scope="col" class="testInfo">Informations du test</th>
          <th scope="col" class="testStatus">Statut global</th>
          <th scope="col" class="subResult">Statut</th>
          <th scope="col" class="context">Contexte</th>
        </tr></thead><tbody>
    
          <?php echo $sf_data->getRaw('output') ?>
        
        </tbody></table>
        
      </div>
    </div>
    <div id="resizeHandler"></div>
    <div id="tested">
      <div class="inner">
        <?php
        /*
        <iframe src="<?php echo $page->getUrl() ?>" name="testedPage"></iframe>
         */ 
        ?>
        <iframe src="<?php echo url_for('pageSource', $extraction) ?>" name="testedPage"></iframe>
       </div>
    </div>
  </body>
</html>  