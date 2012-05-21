<td>
<?php
echo link_to('Modifier'
			,$helper->getUrlForAction('edit')
			,$sfGuardGroup
			,array('class' => 'ico modifier')
	)
?>
<?php
if (!$sfGuardGroup->isNew())
echo link_to('Supprimer'
			,$helper->getUrlForAction('delete')
			,$sfGuardGroup
			,array('class' => 'ico supprimer'
					,'method'=>'delete'
					,'confirm'=> 'Êtes-vous sûr ?')
	)
?>
</td>
