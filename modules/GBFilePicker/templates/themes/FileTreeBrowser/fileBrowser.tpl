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

{if $gbfp_mode != 'dropdown' && isset($gbfp_files)}
	{if $gbfp_files|@count > 1}
	
	<ul class="jqueryFileTree" style="display: none;">
		
		{foreach from=$gbfp_files item=file}
			{if $file->basename != '..'}
		<li class="{if $file->is_dir}directory{else}file ext_{$file->extension}{/if}">
			<a href="#" rel="{$file->relurl}">{$file->basename}</a>
		</li>
			{/if}
		{/foreach}
		
	</ul>
	
	{/if}
{/if}

{/strip}
