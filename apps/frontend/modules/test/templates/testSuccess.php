
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

<h1>Configuration des tests - Etape 4/5</h1>
<form name="tests" method="post" action="<?php echo url_for('test/test') ?>">
  <?php echo $form ?>
  <p>
    <input type="button" value="Tout sélectionner" onclick='toutCocher();'>
    <input type="reset"  value="Tout désélectionner">
    <input type="submit" value="Suivant" />
  </p>
</form>