{*------------------------------------------------------------------------------

Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
         a content management tool for CMS Made Simple
         The projects homepage is http://dev.cmsmadesimple.org/projects/content2
         CMS Made Simple is (c) 2004-2013 by Ted Kulp (wishy@cmsmadesimple.org)
         The projects homepage is: http://www.cmsmadesimple.org
Version: 0.9.4
File   : addMultiInputTpl.tpl
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
{$start_form}
<div class="pageoverflow">
	<div class="pagetext">{$tpl_name_text}</div>
	<div class="pageinput">{$tpl_name_input}<br /></div>
</div>
<div class="pageoverflow">
	<div class="pagetext">{$template_text}</div>
	<div class="pageinput">
		<table style="vertical-align:top">
			<tbody>
				<tr>
					<td style="vertical-align:top">
						{$template_input}
					</td>
					<td style="vertical-align:top">
						{$help_text}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="pageoverflow">
	<div class="pagetext">&nbsp;</div>
	<div class="pageinput">{$submit}&nbsp;{$cancel}<br /></div>
</div>
{$end_form}
