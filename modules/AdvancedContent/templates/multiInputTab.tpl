{*------------------------------------------------------------------------------

Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
         a content management tool for CMS Made Simple
         The projects homepage is http://dev.cmsmadesimple.org/projects/content2
         CMS Made Simple is (c) 2004-2013 by Ted Kulp (wishy@cmsmadesimple.org)
         The projects homepage is: http://www.cmsmadesimple.org
Version: 0.9.4
File   : multiInputTab.tpl
License: GPL

------------------------------------------------------------------------------*}

{if isset($errormessage) && $errormessage!=''}
<div class="pageerrorcontainer">
	<div class="pageoverflow">
		<ul class="pageerror"><li>{$errormessage}</li></ul>
	</div>
</div>
{/if}
{if isset($message) && $message!=''}
<div class="pageoverflow">
	<div class="pagemcontainer">
		<p>{$message}</p>
	</div>
</div>
{/if}

<div class="pageoptions">
	{$add_multi_input}
	<div class="clearb"></div>
</div>

{if $multi_input_array|@count}
{$start_form}

<div class="pageoverflow">
	<table class="pagetable" cellspacing="0" cellpadding="1">
		<thead>
			<tr>
				<th>{$input_id_text}</th>
				<th>{$template_text}</th>
				<th class="pageicon">&nbsp;</th>
				<th class="pageicon">&nbsp;</th>
				<th class="pageicon">{$selectall}</th>
			</tr>
		</thead>
		<tbody>
		
		{foreach from=$multi_input_array item="multi_input"}
		
			<tr class="{cycle values="row1,row2"}">
				<td>{$multi_input.name_link}</td>
				<td>{$multi_input.template}</td>
				<td>{$multi_input.edit_link}</td>
				<td>{$multi_input.delete_link}</td>
				<td>{$multi_input.checkbox}</td>
			</tr>
			
		{/foreach}
			
		</tbody>
	</table>
</div>

<div class="pageoptions">
	{$add_multi_input}
	<div style="margin-top: 0pt; float: right; text-align: right;">
		{$submit_bulkaction}
	</div>
	<div class="clearb"></div>
</div>

{$end_form}
{/if}
