<td>
<?php
echo link_to('Modifier'
      ,$helper->getUrlForAction('edit')
      ,$sfGuardGroup
      ,array('class' => 'ico modifier popupScreen')
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
<?php 
echo link_to(__('Associer les tests', array(), 'messages')
            ,url_for('sf_guard_group_assoc_test', array('id'=>$sfGuardGroup->getId()))
            ,array('class' => 'ico associer')
           )
?>
</td>
