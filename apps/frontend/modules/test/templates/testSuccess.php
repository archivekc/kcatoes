
<script language="javascript">
function toutCocher()
{
  for (i=0; i<document.tests.length; i++)
  {
    if (document.tests.elements[i].type == 'checkbox')
    {
      document.tests.elements[i].checked = true;
    }
  }
}
</script>

<h2><span>Configuration des tests - Etape <em>4</em>/5</span></h2>
<form name="tests" method="post" action="<?php echo url_for('test/test') ?>">
  <?php echo $form ?>
  <p>
    <input type="button" value="Tout sélectionner" onclick='toutCocher();'>
    <input type="reset"  value="Tout désélectionner">
    <input type="submit" value="Suivant" />
  </p>
</form>