{literal}
<script type="text/javascript">
	function select_allx() {
		if ($('#selectallx').is(':checked')) {
			//console.log($('.deletable input[type="checkbox"]:not([name="junk"])'));
			$('.deletable input[type="checkbox"]:not([name="junk"])').prop('checked', true);
		} else {
			$('.deletable input[type="checkbox"]:not([name="junk"])').prop('checked', false);
		}
	}
	
	function confirm_deletex() {
		return confirm('{/literal}{$mod->Lang("confirm_delete_selectedx")}{literal}');
	}
</script>
{/literal}
{$startform}
<div class="pageoverflow">
{if $all_array|@count > 0}
	<table cellspacing="0" class="pagetable cms_sortable tablesorter deletable">
		<thead>
			<tr>
				<th>{$mod->Lang('mtitle_title')}</th>
				<th>{$mod->Lang('mtitle_ex_date')}</th>
				<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
				<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
				<th class="pageicon {literal}{sorter: false}{/literal}"><input id="selectallx" type="checkbox" name="junk" onclick="select_allx();"/></th>
			</tr>
		</thead>
		<tbody>
		{foreach from=$all_array item="item"}
			<tr>
				<td>{$item.title}</td>
				<td>{$item.ex_date}</td>
				<td>{$item.edit_link}</td>
				<td>{$item.delete_link}</td>
				<td><input type="checkbox" name="{$feuactionid}selectedx[]" value="{$item.id}"/></td>
			</tr>
		{/foreach}
		</tbody>
	</table>
{/if}
</div>
<div class="pageoverflow">
	<div style="float: left;">{$addlink}</div>
	<div style="float: right;"><input type="submit" name="{$feuactionid}bulkdelete" value="{$mod->Lang('delete_selected')}" onclick="return confirm_deletex();"/></div>
</div>
{$endform}