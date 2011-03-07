<?php use_helper('File') ?>

<h1>Exécution</h1>

<p class="erreur"><?php echo $erreur ?></p>
<p class="info"><?php echo $info ?></p>
<?php if($cheminFichierCsv != ''): ?>
<p><a href="<?php echo transformForWeb($cheminFichierCsv) ?>">Télécharger le fichier CSV</a></p>
<?php endif ?>