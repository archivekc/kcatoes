<?php use_helper('File') ?>

<h2><span>Exécution</span></h2>

<p class="info"><?php echo $info ?></p>
<p class="erreur"><?php echo $erreur ?></p>

<?php if($cheminFichierCsv != ''): ?>
  <p><a href="<?php echo transformForWeb($cheminFichierCsv) ?>">Télécharger le fichier CSV</a></p>
<?php endif ?>