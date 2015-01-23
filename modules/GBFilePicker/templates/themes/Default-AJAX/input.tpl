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

<span class="GBFP_input_wrapper GBFP_{$gbfp_media_type} GBFP_{$gbfp_mode}" id="GBFP_{$gbfp_cssid}">
{literal}
<script language="javascript" type="text/javascript">
gbfp_onload.push(function(){
	GBFP.registerInput({{/literal}
		id: '{$gbfp_cssid}',
		moduleId: '{$gbfp_id}',
		dir:'{$gbfp_dir}',
		mode:'{$gbfp_mode}',
		browseUrl:'{if $gbfp_mode == "dropdown"}{$gbfp_reload_dropdown_url}{else}{$gbfp_browse_url}{/if}'{if $gbfp_upload_url},
		uploadUrl:'{$gbfp_upload_url}'{/if}
	{literal}});
});
</script>
{/literal}
{if $gbfp_prompt}
	<label for="{$gbfp_cssid}">{$gbfp_prompt}:</label>&nbsp;
{/if}
<span id="{$gbfp_cssid}_GBFP_{$gbfp_mode}_wrapper" class="GBFP_{$gbfp_mode}_wrapper">
	{$gbfp_input}
</span>
{if $gbfp_browse_link}
	<a href="#" class="GBFP_link GBFP_browse" id="{$gbfp_cssid}_GBFP_browse" onclick="return false;">{$gbfp_browse_text}</a>
{/if}
{if $gbfp_clear_link}
	&nbsp;|&nbsp;{$gbfp_clear_link}
{/if}
{if $gbfp_upload_link}
	&nbsp;|&nbsp;
	<a href="#" class="GBFP_link GBFP_upload" id="{$gbfp_cssid}_GBFP_upload" onclick="return false;">{$gbfp_upload_text}</a>
{/if}
{if $gbfp_mode == 'dropdown' && $gbfp_reload_dropdown_link}
	&nbsp;|&nbsp;{$gbfp_reload_dropdown_link}
{/if}

&nbsp;<img class="GBFP_loading_img" src="{root_url}/modules/GBFilePicker/templates/themes/Default-AJAX/img/loading.gif" alt="" />

{if $gbfp_media_type == 'image'}
	<br />
	<span id="{$gbfp_cssid}_GBFP_thumbnail_wrapper" class="GBFP_thumbnail_wrapper">
		{if $gbfp_value != ''}
		<img class="GBFP_thumbnail" id="{$gbfp_cssid}_GBFP_thumbnail" src="{$gbfp_thumburl}" width="{$gbfp_thumb_width}" height="{$gbfp_thumb_height}" alt="{$gbfp_value}" title="{$gbfp_value}" />
		{/if}
	</span>
{/if}
</span>
{/strip}
