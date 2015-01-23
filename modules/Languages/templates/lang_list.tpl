{if $list|@count > 0}
	<table cellspacing="0" class="pagetable">
		<thead>
			<tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				{foreach from=$names_to_show item="it"}
					<th class="pageicon">{$it}</th>
				{/foreach}
				<th class="pageicon">&nbsp;</th>
				<th class="pageicon">&nbsp;</th>
				<th class="pageicon">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$list item=entry}
				<tr>
					<td>{$entry.id}</td>
					<td>{$entry.system_name}</td>
					
					{foreach from=$fields_to_show item="it"}
						<td>{$entry.$it}</td>
					{/foreach}
					
					<td>{$entry.files}</td>
					<td>{$entry.edit_url}</td>
					<td>{$entry.delete_url}</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
{/if}

<div class="pageoptions"><p class="pageoptions">{$addlink}</p></div>
<div class="pageoptions"><p class="pageoptions">{$refresh}</p></div>
<div class="pageoptions"><p class="pageoptions">{$read_file}</p></div>
<div class="pageoptions"><p class="pageoptions">{$default_values}</p></div>