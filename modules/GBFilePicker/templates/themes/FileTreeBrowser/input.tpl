{strip}
{*------------------------------------------------------------------------------

  Module : GBFilePicker (c) 2010-2012 by Georg Busch (georg.busch@gmx.net)
           a filepicker tool for CMS Made Simple
           The projects homepage is dev.cmsmadesimple.org/projects/gbfilepicker
           CMS Made Simple is (c) 2004-2012 by Ted Kulp
           The projects homepage is: cmsmadesimple.org
  Version: 1.3.2
  File   : input.tpl
  License: GPL

------------------------------------------------------------------------------*}

<span class="GBFP_fileTreeBrowser_input_wrapper GBFP_fileTreeBrowser_{$gbfp_media_type} GBFP_fileTreeBrowser_{$gbfp_mode}" id="GBFP_fileTreeBrowser_{$gbfp_cssid}">
{literal}
	<script language="javascript" type="text/javascript">
	GBFP_fileTreeBrowser_onload.push(function(){
		jQuery('#{/literal}{$gbfp_cssid}{literal}').GBFP({
{/literal}
{if $gbfp_mode == "browser" && $gbfp_browse_url}
			scriptUrl:'{$gbfp_browse_url}&{$gbfp_id}showtemplate=false&{$gbfp_id}disable_theme=1&{$gbfp_id}ajax=1',
			browseText:'Browse files...',
{else if $gbfp_mode == "dropdown" && $gbfp_upload_url}
			scriptUrl:'{$gbfp_upload_url}&{$gbfp_id}showtemplate=false&{$gbfp_id}disable_theme=1&{$gbfp_id}ajax=1',
			browseText:'Upload',
			selectText:false,
{/if}
			urlParam:'{$gbfp_id}dir',
			template:'{root_url}/modules/GBFilePicker/templates/themes/FileTreeBrowser/js/tpl/browser.html',
			rootDir:'{$gbfp_dir}'
{literal}
		});
	});
	</script>
{/literal}
{if $gbfp_prompt}
	<label for="{$gbfp_cssid}">{$gbfp_prompt}:</label>&nbsp;
{/if}
	<span id="{$gbfp_cssid}_GBFP_fileTreeBrowser_{$gbfp_mode}_wrapper" class="GBFP_fileTreeBrowser_{$gbfp_mode}_wrapper">
{$gbfp_input}
	</span>
</span>
{/strip}
