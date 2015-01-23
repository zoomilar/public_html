<h3>{$title_filelists_list}</h3>

<div id="doc_filter">
	{$start_form}
	<div class="pageoverflow">
	   <p class="pagetext">{$title_cat_id}</p>
	   <p class="pageinput">{$input_cat_id}</p>
	</div>
	{*<div class="pageoverflow">
	   <p class="pagetext">{$title_user_id}</p>
	   <p class="pageinput">{$input_user_id}</p>
	</div>*}
	<div class="pageoverflow">
	   <p class="pagetext">{$title_search_field}</p>
	   <p class="pageinput">{$input_search_field}</p>
	</div>
	<div class="pageoverflow">
	   <p class="pageinput">{$submit} {$reset}</p>
	</div>
	{$end_form}
</div>
<br/>
<div id="filelists_list">
{if $item_count > 0}
	<table cellspacing="0" class="pagetable cms_sortable tablesorter">
		<thead>
			<tr>
				<th>{$idtext}</th>
				<th>{$filenametext}</th>
				<th>{$datetext}</th>
				<th>{$activetext}</th>
				<th>{*$deletedtext*}</th>
				<th>{*$usertext*}</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$items item=entry}
				{cycle values="row1,row2" assign='rowclass'}
				<tr class="{$rowclass}">
					<td>
						{$entry.id}
					</td>
					<td>
						{$entry.filename}
					</td>
					<td>
						{$entry.date}
					</td>
					<td>
						{if $entry.active == 1}
							{$mod->Lang('user_status_val1')}
						{else}
							{$mod->Lang('user_status_val0')}
						{/if}
					</td>
					<td>
						{*if $entry.deleted == 1}
							{$mod->Lang('yes')}
						{else}
							{$mod->Lang('no')}
						{/if*}
					</td>
					<td>
						{*if $entry.user[0]}
							{$entry.user_name} {$entry.user_surename} ({$entry.user[1]['username']})
						{/if*}
					</td>
					<td>
						{$entry.editlink}
					</td>
					<td>
						{$entry.deletelink}
					</td>
				</tr>
			{/foreach}
		</tbody>
		
	</table>
{/if}
	<div class="pageoptions" style="height: 2em;">
		<div style="width: 40%; float: left; margin-top: 0.5em;">
		  {$addlink}
		</div>
		{*if $itemcount gt 0}
		  <div style="text-align: right; width: 40%; float: right; margin-top: 0.5em; margin-bottom: 0.5em;">
			{$mod->Lang('with_selected')}:
			<select name="{$actionid}bulkaction">{html_options options=$bulkactions}</select>
			<input type="submit" id="bulkaction_submit" name="{$actionid}submit" value="{$mod->Lang('go')}"/>
		  </div>
		{/if*}
	</div>
</div>