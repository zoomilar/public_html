{strip}
{*------------------------------------------------------------------------------

  Module : GBFilePicker (c) 2010-2012 by Georg Busch (georg.busch@gmx.net)
           a filepicker tool for CMS Made Simple
           The projects homepage is dev.cmsmadesimple.org/projects/gbfilepicker
           CMS Made Simple is (c) 2004-2012 by Ted Kulp
           The projects homepage is: cmsmadesimple.org
  Version: 1.3.2
  File   : fileBrowser.tpl
  License: GPL

------------------------------------------------------------------------------*}
{literal}{{/literal}
{if $gbfp_mode != "dropdown" && isset($gbfp_files) && $gbfp_files|@count}
	{foreach from=$gbfp_files item=file name="files"}
		"{$file->basename}": {literal}{{/literal}
		{foreach from=$file|@get_object_vars key="propname" item="propvalue" name="fileprops"}
			"{$propname}":{if $propvalue|@is_bool}{if $propvalue}true{else}false{/if}{else}"{$propvalue|replace:'"':"'"}"{/if}{if !$smarty.foreach.fileprops.last},{/if}
		{/foreach}
		{literal}}{/literal}{if !$smarty.foreach.files.last},{/if}
	{/foreach}
{/if}
{literal}}{/literal}
{/strip}
