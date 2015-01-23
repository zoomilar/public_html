{$start_form}
	{*<div class="pageoverflow">
		<p class="pagetext">{$title_allow_add}:</p>
		<p class="pageinput">{$input_allow_add}</p>
	</div>*}
	<div class="pageoverflow">
		<p class="pagetext">{$title_launguage_list}:</p>
		<p class="pageinput">{$input_launguage_list}</p>
	</div>
	{if $input_main_language}
		<div class="pageoverflow">
			<p class="pagetext">{$title_main_language}:</p>
			<p class="pageinput">{$input_main_language}</p>
		</div>
	{/if}
	
	
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$submit}</p>
	</div>
{$end_form}
