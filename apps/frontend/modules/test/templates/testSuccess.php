
<script language="javascript">
function toutcocher()
{
  for(i=0;i<document.tests.length;i++)
  {
  if(document.tests.elements[i].type=="checkbox")
  document.tests.elements[i].checked=true;
  }
}
</script>

<form name="tests" method="post" action="<?php echo url_for('test/test') ?>">
  <?php echo $form ?>
  <p>
    <input type='button'   value="Tout sélectionner" onclick='toutcocher();'>
    <input type="reset" value="Tout désélectionner">
    <input type="submit" value="Suivant" />
  </p>
</form>