<td>
<?php
echo link_to('Modifier'
			,$helper->getUrlForAction('edit')
			,$utilisateur
			,array('class' => 'ico modifier')
	)
?>
<?php
if (!$utilisateur->isNew())
echo link_to('Supprimer'
			,$helper->getUrlForAction('delete')
			,$utilisateur
			,array('class' => 'ico supprimer'
					,'method'=>'delete'
					,'confirm'=> 'Êtes-vous sûr ?')
	)
?>
</td>
