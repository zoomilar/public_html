{$start_form}
	{*<div class="pageoverflow">
		<p class="pagetext">{$title_allow_add}:</p>
		<p class="pageinput">{$input_allow_add}</p>
	</div>*}
	<div class="pageoverflow">
	  <p class="pagetext">{$prompt_kalbos}:</p>
	  <p class="pageinput">{$input_kalbos}</p>
	</div>
	<div class="pageoverflow">
	  <p class="pagetext">{$prompt_admin_email}:</p>
	  <p class="pageinput">{$input_admin_email}</p>
	</div>
	{*<div class="pageoverflow">
	  <p class="pagetext">{$prompt_calendar_mail}:</p>
	  <p class="pageinput">{$input_calendar_mail}</p>
	</div>
	<div class="pageoverflow">
	  <p class="pagetext">{$prompt_calendar_pass}:</p>
	  <p class="pageinput">{$input_calendar_pass}</p>
	</div>*}
	
{if $input_pg_field|@count > 0}
	{foreach from=$input_pg_field item="vll"}
		<div class="pageoverflow">
			<p class="pagetext">{$vll.name}:</p>
			<p class="pageinput">{$vll.value}</p>
		</div>
	{/foreach}
{/if}

	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$submit}</p>
	</div>
{$end_form}
