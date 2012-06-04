<td>
<?php
echo link_to('Modifier'
			,$helper->getUrlForAction('edit')
			,$sfGuardPermission
			,array('class' => 'ico modifier popupScreen')
	)
?>
<?php
if (!$sfGuardPermission->isNew())
echo link_to('Supprimer'
			,$helper->getUrlForAction('delete')
			,$sfGuardPermission
			,array('class' => 'ico supprimer'
					,'method'=>'delete'
					,'confirm'=> 'Êtes-vous sûr ?')
	)
?>
</td>
