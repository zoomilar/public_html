{*------------------------------------------------------------------------------

  Module : GBFilePicker (c) 2010-2012 by Georg Busch (georg.busch@gmx.net)
           a filepicker tool for CMS Made Simple
           The projects homepage is dev.cmsmadesimple.org/projects/gbfilepicker
           CMS Made Simple is (c) 2004-2012 by Ted Kulp
           The projects homepage is: cmsmadesimple.org
  Version: 1.3.2
  File   : defaultadmin.tpl
  License: GPL

------------------------------------------------------------------------------*}

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
