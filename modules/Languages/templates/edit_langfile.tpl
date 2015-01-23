{$startform}
	{$hidden}
	<div class="pageoverflow">
		<p class="pagetext">{$title_system_name}:</p>
		<p class="pageinput">{$system_name}</p>
	</div>
	{if $values|@count > 0}
		{foreach from=$values item="val"}
			<div class="pageoverflow">
				<p class="pagetext">{$val.title}:</p>
				<p class="pageinput">{$val.value}</p>
			</div>
		{/foreach}
	{/if}
	<div class="pageoverflow">
		<p class="pagetext">{$title_description}:</p>
		<p class="pageinput">{$description}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$title_files}:</p>
		<p class="pageinput">{$files|nl2br}</p>
	</div>
	
	
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$submit} {$cancel}</p>
	</div>
{$endform}
