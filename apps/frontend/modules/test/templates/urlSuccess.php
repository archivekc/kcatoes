<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php //echo form_tag_for($form, '@test') ?>
<form method="post" action="thematique">
  <table id="url_form">
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="Suivant" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php $widget = $form['url'] ?>
      <?php echo $widget->renderError() ?>
      <?php echo $widget->renderRow() ?>
    </tbody>
  </table>
</form>