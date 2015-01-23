{*------------------------------------------------------------------------------

Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
         a content management tool for CMS Made Simple
         The projects homepage is http://dev.cmsmadesimple.org/projects/content2
         CMS Made Simple is (c) 2004-2013 by Ted Kulp (wishy@cmsmadesimple.org)
         The projects homepage is: http://www.cmsmadesimple.org
Version: 0.9.4
File   : multiInput.tpl
License: GPL

------------------------------------------------------------------------------*}

<div class="pageoverflow">
<p>
{foreach from=$inputs item=input}
	{$input.label}:&nbsp;{$input.input}&nbsp;
{/foreach}
</p>
</div>
