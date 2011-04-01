<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php //echo form_tag_for($form, '@test') ?>
<form method="post" action="<?php echo url_for('test/thematique') ?>">
  <table id="url_form">
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="Suivant" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>