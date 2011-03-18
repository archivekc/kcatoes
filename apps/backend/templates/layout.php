<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>KCatoes Admin Interface</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php use_stylesheet('admin.css') ?>
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
  </head>
  <body>
    <div id="container">
      <div id="menu">
        <ul>
          <li>
            <?php echo link_to('Thématiques', 'thematique') ?>
          </li>
          <li>
            <?php echo link_to('Référentiels', 'referentiel') ?>
          </li>
          <li>
            <?php echo link_to('Regroupements', 'regroupement') ?>
          </li>
          <li>
            <?php echo link_to('Tests', 'test') ?>
          </li>
        </ul>
      </div>
      <div id="content">
        <?php echo $sf_content ?>
      </div>
    </div>
  </body>
</html>