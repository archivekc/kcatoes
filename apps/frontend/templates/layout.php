<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <?php include_http_metas() ?>
    
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
    
    <script type="text/javascript">
    var GLOBAL = {
      loginUrl: '<?php echo url_for('sf_guard_signin') ?>'
    , launchTestsUrl: '<?php echo url_for('executionTests') ?>'
    };
    </script>
  </head>
  <body>
    <div id="wrap">
      <div id="head">
        <p id="teaser"><strong>KCatoès</strong> est un outil automatique d'assistance aux tests d'accessibilité</p>
        <?php include_partial('global/userZone', array())?>
      </div>

      <div id="aside">
          <a id="KCatoesLogo" href="<?php echo url_for('homepage') ?>" title="page d'accueil">
            <img src="/img/kcatoes-128.png" alt="K Catoès"/>
          </a>
          
          <div id="mainMenu">
            <strong>Menu</strong>
		        <ul class="menu">
		          <?php /* 
		          <li>
			           <?php include_component('composants', 'menuDisplay')?>
			        </li> */
			        ?>
			        <?php if(!$sf_user->isAuthenticated()): ?>
			        <li>
			          <a href="<?php echo url_for('connexion')?>">Connexion</a>
			        </li>
			        <?php endif ?>
		          <?php if($sf_user->isAuthenticated()): ?>
		          <li>
			            <a href="<?php echo url_for('pageIndex')?>">Pages web</a>
		          </li>
		          <li>
		              <a href="<?php echo url_for('scenarioIndex')?>">Scénarios</a>
		          </li>
              <li>
                  <a href="<?php echo url_for('scenarioTemplateIndex')?>">Modèles de scénario</a>
              </li>
		          <?php endif ?>
		          <li>
		            <a href="<?php echo url_for('editorial')?>">Documentation</a>
		          </li>
	          </ul>
            
	          <?php if($sf_user->isAuthenticated() && $sf_user->hasCredential('admin')): ?>
		        <strong>Administration</strong>
		        <ul class="menu">
		          <li>
		            <a href="<?php echo url_for('sf_guard_user')?>">Gestion des utilisateurs</a>
		          </li>
		          <li>
		            <a href="<?php echo url_for('sf_guard_group')?>">Gestion des profils</a>
		          </li>
		          <li>
		            <a href="<?php echo url_for('sf_guard_permission')?>">Gestion des rôles</a>
		          </li>
            </ul>
            <?php endif ?>

            <p id="copyright">
              Version <?php echo sfConfig::get('app_version') ?> -
              <?php echo sfConfig::get('app_date') ?>
            </p>
		      </div>
          
      </div>

      <div id="main">
        <div id="page">
          <?php echo $sf_content ?>
        </div>
      </div>
    </div>
  </body>
</html>
