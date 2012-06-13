<?php use_helper('Ihm')?>
<h1>Gestion des extractions</h1>
<ul class="tabHeads" id="extracts">
<?php foreach($extracts as $extract):?>
  <li>
    <a href="#extract<?php echo $extract->getId() ?>">
      <?php echo $extract->getType() ?>
    </a>
  </li>
<?php endforeach ?>
</ul>

<?php foreach($extracts as $extract):?>
  <?php $url = url_for('pageExtractSrc', array('id'=>$extract->getId())) ?>
  <div id="extract<?php echo $extract->getId() ?>" class="extract tab">
    <?php if ($extract->getType() == 'base'):?>
    <form method="post" action="#" id="addExtractForm">
      <?php if ($addExtractForm->hasGlobalErrors()):?>
      <div>
        <?php echo $addExtractForm->renderGlobalErrors() ?>
      </div>
      <?php endif ?>
      <div>
        <?php echo $addExtractForm->renderHiddenFields() ?>
	      <noscript>
				  <?php echo userMsg('Cette fonctionnalité nécessite l\'activation de JavaScript', 'warning')?>
				</noscript>
			  <a href="javascript:void(0)" id="getJsCode">Récupérer le code source généré après chargement du javascript</a>
			</div>
    </form>
    <?php endif ?>
    <div class="iframeContent">
	    <iframe src="<?php echo $url?>">
	      <a href="<?php echo $url?>" target="_blank">Voir cette extraction dans une nouvelle fenêtre</a>
	    </iframe>
    </div>
    <!-- <a href="#extracts" class="skipLink">Retour à la liste des extractions</a>  -->
  </div>
<?php endforeach ?>

<script type="text/javascript">
$(function(){
	$('#getJsCode').click(function(){
		try{
			var srcIframe = $(this).closest('.extract').find('iframe')[0].contentDocument;
			var htmlTag = srcIframe.getElementsByTagName('html')[0]; 
			var headAndBody = htmlTag.innerHTML;
			var src = '<html ';
			for (var i=0, l=htmlTag.attributes.length; i<l; i++){
				src += htmlTag.attributes[i].nodeName+'="'+htmlTag.attributes[i].nodeValue+'" ';
			}
			src += '>'+htmlTag.innerHTML;+'</html>';
			$('#webPageExtract_src').val(src);
			$(this).closest('form').submit();
			
		} catch(e) {
			alert('une erreur est survenue lors de l\'extraction du code source.\nRechargez la page et essayez à nouveau.');
		}
	});
});
</script>