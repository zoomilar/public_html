{*------------------------------------------------------------------------------

Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
         a content management tool for CMS Made Simple
         The projects homepage is http://dev.cmsmadesimple.org/projects/content2
         CMS Made Simple is (c) 2004-2013 by Ted Kulp (wishy@cmsmadesimple.org)
         The projects homepage is: http://www.cmsmadesimple.org
Version: 0.9.4
File   : addMultiInput.tpl
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
	<p class="pagetext">{$input_id_text}</p>
	<p class="pageinput">{$input_id_input}<br /></p>
</div>
<div class="pageoverflow">
	<p class="pagetext">{$input_tpl_text}</p>
	<p class="pageinput">{$input_tpl_input}<br /></p>
</div>
<div class="pageoverflow">
	<p class="pagetext">{$input_fields_text}</p>
	<p class="pageinput">{$input_fields_input}<br /></p>
</div>
<div class="pageoverflow">
	<p class="pagetext">&nbsp;</p>
	<p class="pageinput">{$submit}&nbsp;{$cancel}<br /></p>
</div>
{$end_form}
