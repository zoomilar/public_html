{if count($entries)}
<div class="pageoverflow">
	
  <table class="pagetable" cellspacing="0">
    <thead>
      <tr>
        <th width="2%">{$mod->Lang('id')}</th>
        <th>{$mod->Lang('hierarchy')}</th>
        <th>&nbsp;</th>
        <th class="pageicon">&nbsp;</th>
        <th class="pageicon">&nbsp;</th>
      </tr>
    </thead>
    <tbody>
    {foreach from=$entries item='oneentry'}
      {cycle values="row1,row2" assign='rowclass'}
      <tr class="{$rowclass}" onmouseover="this.className='{$rowclass}hover';" onmouseout="this.className='{$rowclass}';">
	<td>{$oneentry.id}</td>
        <td>{cgrepeat text='&nbsp;&gt;&nbsp;' count=$oneentry.depth}<a href="{$oneentry.edit_url}" title="{$mod->Lang('edit_hierarchy_item')}">{$oneentry.name.lt}</a></td>
        <td>{if $oneentry.product_order_url}<a href="{$oneentry.product_order_url}">{$mod->Lang('order_product_in_hier')}</a>{/if}</td>
        <td>{$oneentry.edit_link}</td>
        <td>{$oneentry.delete_link}</td>
      </tr>
    {/foreach}
    </tbody>
  </table>
</div>
{/if}

<p class="pageoverflow">
  {$add_hierarchy_link}&nbsp;{$reorder_link|default:''}
</p>