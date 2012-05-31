<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php $rubrique = isset($_SERVER['rubrique'])?$_SERVER['rubrique']:'' ?> <html xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_javascripts() ?>
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
          <div id="mainMenu">
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
		              <a href="<?php echo url_for('scenarioIndex')?>">Scenarii</a>
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
          
		      <?php if($sf_user->isAuthenticated()): ?>
          <div id="logoutBtn">
            <div id="connectedUser">
              <?php echo $sf_user->getName(); ?>
              <ul id="userGroups">
                <?php foreach($sf_user->getGroups() as $group): ?>
                  <li><?php echo $group->getName(); ?></li> 
                <?php endforeach; ?>
              </ul>
            </div>
            <a class="actionButton" href="<?php echo url_for('sf_guard_signout')?>">Déconnexion</a>
          </div>
          <?php endif ?>
          
      </div>
      <div id="main">
        <div id="page">
          <?php echo $sf_content ?>
        </div>
      </div>
    </div>
  </body>
</html>
