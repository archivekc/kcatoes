<div class="sf_admin_actions">
<?php if ($form->isNew()): ?>
	<?php
	echo link_to('Retour à la liste'
				,$helper->getUrlForAction('list')
				,$sfGuardGroup
				,array('class' => 'ico liste')
		)
	?>

	<input type="submit" value="<?php echo __('Save', array(), 'sf_admin') ?>"/>
	<input type="submit" value="<?php echo __('Save and add', array(), 'sf_admin') ?>"/>
<?php else: ?>
	<?php
	echo link_to('Retour à la liste'
				,$helper->getUrlForAction('list')
				,$sfGuardGroup
				,array('class' => 'ico liste')
		)
	?>
	<?php
	echo link_to('Supprimer'
				,$helper->getUrlForAction('delete')
				,$sfGuardGroup
				,array('class' => 'ico supprimer'
						,'method'=>'delete'
						,'confirm'=> 'Êtes-vous sûr ?')
		);

	?>
	<input type="submit" value="<?php echo __('Save', array(), 'sf_admin') ?>"/>
	<input type="submit" value="<?php echo __('Save and add', array(), 'sf_admin') ?>"/>

<?php endif; ?>
</div>
