<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php //include_javascripts() ?>
    <?php include_stylesheets() ?>
    
  </head>
  <body>
    <div id="wrap">
      <div id="head">
        <h1 id="headLogo">
          <a id="KCatoesLogo" href="<?php echo url_for('homepage') ?>" title="page d'accueil">
            <img src="/img/kcatoes-128.png" alt="K Catoès"/>
          </a>
        </h1>
        <p id="teaser"><strong>KCatoès</strong> est un outil automatique d'assistance aux tests d'accessibilité</p>
      </div>
      <div id="aside">
        <ul id="menu">
          <li><a href="<?php echo url_for('webPages')?>">Pages web</a></li>
          <li><a href="<?php echo url_for('testConfigs')?>">Configurations de test</a></li>
          <li><a href="<?php echo url_for('credits')?>">Crédits</a></li>
        </ul>
      </div>
      <div id="main">
        <div id="page">
          <?php echo $sf_content ?>
        </div>
        <p id="copyright">
		        Version <?php echo sfConfig::get('app_version') ?> -
		        <?php echo sfConfig::get('app_date') ?>
		    </p>
      </div>
    </div>
  </body>
</html>
