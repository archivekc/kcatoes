<div class="sf_admin_list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result', array(), 'sf_admin') ?></p>
  <?php else: ?>
    <table cellspacing="0">
      <thead>
        <tr>
          <?php include_partial('sfGuardPermission/list_th_tabular', array('sort' => $sort)) ?>
          <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pager->getResults() as $i => $permission): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr class="sf_admin_row <?php echo $odd ?>">
            <?php include_partial('sfGuardPermission/list_td_tabular', array('sfGuardPermission' => $permission)) ?>
            <?php include_partial('sfGuardPermission/list_td_actions', array('sfGuardPermission' => $permission, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="pagination">
      <div class="paginateResume">
        <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>

        <?php if ($pager->haveToPaginate()): ?>
          <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
        <?php endif; ?>
      </div>

      <?php if ($pager->haveToPaginate()): ?>
        <div class="paginateLinks">
          <?php include_partial('sfGuardPermission/pagination', array('pager' => $pager)) ?>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
