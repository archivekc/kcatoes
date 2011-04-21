<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
	  <div id="main">
	    <div id="header">
	      <a href="<?php url_for('homepage')?>" id="logo">
	        <img alt="KCatoès" src="/img/kcatoes-128.png"/>
	      </a>
	      <a href="http://keyconsulting.fr" id="logoKC">
          <img alt="KCatoès" src="/img/KeyConsulting.jpg"/>
        </a>
	      <h1><strong>Kcatoès</strong> est un outil automatique d'assitance aux test d'accessiblité</h1>
	    </div>
	    <div id="content">
	       <div class="preDeco"></div>
	       <div class="innerContent">
    	     <?php echo $sf_content ?>
    	   </div>
    	   <div class="postDeco"></div>
      </div>
      <div id="footer">
		    Version <?php echo sfConfig::get('app_version') ?> -
		    <?php echo sfConfig::get('app_date') ?> -
		    Key Consulting
      </div>
	  </div>
  </body>
</html>
