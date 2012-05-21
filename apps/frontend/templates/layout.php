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
        <ul id="menu">
          <?php if($sf_user->isAuthenticated()): ?>
          <li>
            <?php if ($rubrique == 'homepage'):?>
              <span>Accueil</span>
            <?php else: ?>
	            <a href="<?php echo url_for('homepage')?>">Accueil</a>
            <?php endif ?>
          </li>
          <li>
            <?php if ($rubrique == 'page'):?>
              <span>Pages web</span>
            <?php else: ?>
	            <a href="<?php echo url_for('pageIndex')?>">Pages web</a>
            <?php endif ?>
          </li>
          <li>
            <?php if ($rubrique == 'scenarii'):?>
              <span>Scenarii</span>
            <?php else: ?>
              <a href="<?php echo url_for('scenarioIndex')?>">Scenarii</a>
            <?php endif ?>
          </li>
          <li>
            <?php if ($rubrique == 'aide'):?>
              <span>Aide</span>
            <?php else: ?>
              <a href="<?php echo url_for('aide')?>">Aide</a>
            <?php endif ?>
          </li>
          <li>
            <?php if ($rubrique == 'environnementR'):?>
              <span>Environnement recommandé</span>
            <?php else: ?>
              <a href="<?php echo url_for('environnementR')?>">Environnement recommandé</a>
            <?php endif ?>
          </li>
          <li>
            <?php if ($rubrique == 'credit'):?>
              <span>Crédits</span>
            <?php else: ?>
              <a href="<?php echo url_for('credits')?>">Crédits</a>
            <?php endif ?>
          </li>
          <li>
            <a href="<?php echo url_for('sf_guard_user')?>">Gestion des utilisateurs</a>
          </li>
          <li>
            <a href="<?php echo url_for('sf_guard_group')?>">Gestion des profils</a>
          </li>
          <li>
            <a href="<?php echo url_for('sf_guard_permission')?>">Gestion des rôles</a>
          </li>
          <li id="logoutBtn">
              <a href="<?php echo url_for('sf_guard_signout')?>">Déconnexion</a>
          </li>
          <?php endif ?>
          <li>
            <p id="copyright">
              Version <?php echo sfConfig::get('app_version') ?> -
              <?php echo sfConfig::get('app_date') ?>
            </p>
          </li>
        </ul>


      </div>
      <div id="main">
        <div id="page">
          <?php echo $sf_content ?>
        </div>
      </div>
    </div>
  </body>
</html>
