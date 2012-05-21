<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@sf_guard_permission') ?>
    <div>
      <?php echo $form->renderHiddenFields(false) ?>

      <?php if ($form->hasGlobalErrors()): ?>
        <?php echo $form->renderGlobalErrors() ?>
      <?php endif; ?>
      <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php
      switch ($fieldset)
      {
        case 'User':
          $fieldsetLabel = 'Utilisateurs';
          break;
        case 'Permissions and groups':
          $fieldsetLabel = 'Profils et rôles';
          break;
        default:
          $fieldsetLabel = $fieldset;
      }
      ?>

        <?php include_partial('sfGuardPermission/form_fieldset', array('sfGuardPermission' => $sfGuardPermission, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldsetLabel)) ?>
      <?php endforeach; ?>

      <?php include_partial('sfGuardPermission/form_actions', array('sfGuardPermission' => $sfGuardPermission, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </div>
  </form>
</div>
