{*------------------------------------------------------------------------------

Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
         a content management tool for CMS Made Simple
         The projects homepage is http://dev.cmsmadesimple.org/projects/content2
         CMS Made Simple is (c) 2004-2013 by Ted Kulp (wishy@cmsmadesimple.org)
         The projects homepage is: http://www.cmsmadesimple.org
Version: 0.9.4
File   : defaultadmin.tpl
License: GPL

------------------------------------------------------------------------------*}

{if isset($errormessage) && $errormessage!=''}
<div class="pageerrorcontainer">
	<div class="pageoverflow">
		<ul class="pageerror"><li>{$errormessage}</li></ul>
	</div>
</div>
{/if}
<div id="AdvancedContentResult">
	{if isset($message) && $message!=''}
	<div class="pagemcontainer">
		<p class="pagemessage">{$message}</p>
	</div>
	{/if}
</div>

{if $tabs|@count}
	{$start_tabheaders}
		{foreach from=$tabs item=tab}
			{$tab.tabheader}
		{/foreach}
	{$end_tabheaders}
	{$start_tabcontent}
		{foreach from=$tabs item=tab}
			{$tab.tabcontent}
		{/foreach}
	{$end_tabcontent}
{/if}
