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

<div id="GBFP_header">

{if isset($gbfp_currentdir)}

	<div class="breadcrumbs">
		<p class="breadcrumbs">
		
	{if isset($gbfp_starturl)}
			
			<a href="{$gbfp_starturl}" id="GBFP_goto_root" title="{$gbfp_startdir_text}" onclick="GBFP.loadDir(this.href,'{$gbfp_cssid}','{$gbfp_startdir}'); return false;">{$gbfp_startdir_text}</a>
			
			&nbsp;{$gbfp_currentdir_text}:&nbsp;
			
			{assign var="current_breadcrumb" value="$gbfp_startdir"}
			{foreach from=$gbfp_breadcrumbs item=breadcrumb name=current}
				{assign var="current_breadcrumb" value=$current_breadcrumb|cat:'/'|cat:$breadcrumb->filename|@trim:'/'}
				{if $gbfp_currentdir != $current_breadcrumb}
			
			<a href="{$breadcrumb->fileurl}" onclick="GBFP.loadDir(this.href,'{$gbfp_cssid}','{$breadcrumb->id}'); return false;">{$breadcrumb->filename}</a>
			
				{else}
					{$breadcrumb->filename}
				{/if}
				{if !$smarty.foreach.current.last} / {/if}
			{/foreach}
	{else}
			
			<img src="{root_url}/modules/GBFilePicker/images/dir.gif" alt="" />
			
			&nbsp;{$gbfp_currentdir_text}:&nbsp;{$gbfp_currentdir}
			
	{/if}
	
		</p>
	</div>
	<div class="hstippled">&nbsp;</div>
	
{/if}

{if isset($gbfp_formstart)}
{$gbfp_formstart}
	<fieldset id="GBFP_fileoperations_wrapper" class="gbfp_fieldset{if !$gbfp_fileoperations_display} gbfp_no-border{/if}">
	{if $gbfp_mode != 'dropdown'}
		<legend><a href="{$gbfp_prefurl}{if !$gbfp_fileoperations_display}1{else}0{/if}" class="{if !$gbfp_fileoperations_display}gbfp_expand{else}gbfp_contract{/if}" id="GBFP_toggle_fileoperations">{$gbfp_fileoperations_text}</a></legend>
	{/if}
		
		<div {if $gbfp_mode != 'dropdown'}id="GBFP_fileoperations" style="display:{if !$gbfp_fileoperations_display && $gbfp_mode != 'dropdown'}none{else}block{/if}"{/if}>
			<table>
				<tbody>
					<tr>
					{if $gbfp_upload}
						<td>{$gbfp_fileupload_text}:</td>
					{/if}
					{if $gbfp_create_dirs}
						<td>{$gbfp_createdir_text}:</td>
					{/if}
					</tr>
					<tr>
					{if $gbfp_upload}
						<td>{$gbfp_fileupload_input}</td>
					{/if}
					{if $gbfp_create_dirs}
						<td>{$gbfp_createdir_input}</td>
					{/if}
					</tr>
					<tr>
					{if $gbfp_upload && $gbfp_allow_scaling}
						<td>{$gbfp_resizeimage_text}:&nbsp;{$gbfp_resizeimage_input}</td>
					{/if}
					{if $gbfp_create_dirs}
						<td>{$gbfp_createdir_submit}</td>
					{/if}
					</tr>
					{if $gbfp_upload && $gbfp_allow_scaling}
					<tr>
						<td>{$gbfp_imagesize_x_input}&nbsp;x&nbsp;{$gbfp_imagesize_y_input}</td>
					</tr>
					<tr>
						<td>{$gbfp_keepaspectratio_text}:&nbsp;{$gbfp_keepaspectratio_input}</td>
					</tr>
						{if $gbfp_allow_upscaling}
					<tr>
						<td>{$gbfp_forceupscaling_text}:&nbsp;{$gbfp_forceupscaling_input}</td>
					</tr>
						{/if}
					{/if}
					{if $gbfp_upload}
					<tr>
						<td>{$gbfp_fileupload_submit}</td>
					</tr>
					{/if}
				</tbody>
			</table>
		</div>
	</fieldset>
{$gbfp_formend}
{/if}

{if isset($gbfp_errormessage) && $gbfp_errormessage!=""}
	<fieldset class="GBFP_message" id="GBFP_error" onclick="GBFP.tmp.template['#GBFP'].css('height','auto');jQuery(this).fadeTo(GBFP.inputs[GBFP.tmp.currentPickerId].fadeSpeed,0,function(){literal}{{/literal}jQuery(this).animate({literal}{{/literal}height: '0px'{literal}}{/literal}, GBFP.inputs[GBFP.tmp.currentPickerId].animateSpeed , 'swing', function(){literal}{{/literal}jQuery(this).remove();GBFP.resize();{literal}}{/literal}){literal}}{/literal});" style="cursor:pointer">
		<legend>{$gbfp_error_text}</legend>
		{$gbfp_errormessage}
	</fieldset>
{/if}

{if isset($gbfp_message) && $gbfp_message!=""}
	<fieldset class="GBFP_message" id="GBFP_success" onclick="GBFP.tmp.template['#GBFP'].css('height','auto');jQuery(this).fadeTo(GBFP.inputs[GBFP.tmp.currentPickerId].fadeSpeed,0,function(){literal}{{/literal}jQuery(this).animate({literal}{{/literal}height: '0px'{literal}}{/literal}, GBFP.inputs[GBFP.tmp.currentPickerId].animateSpeed , 'swing', function(){literal}{{/literal}jQuery(this).remove();GBFP.resize();{literal}}{/literal}){literal}}{/literal});" style="cursor:pointer">
		<legend>{$gbfp_success_text}</legend>
		{$gbfp_message}
	</fieldset>
{/if}

</div>

{if $gbfp_mode != 'dropdown' && isset($gbfp_files)}

<div id="GBFP_filelist">

	{if $gbfp_files|@count}
	
	<table style="width:100%;" id="GBFP_filetable" class="pagetable" cellspacing="0">
		<tbody>
		{foreach from=$gbfp_files item=file}
		
		<tr class="{cycle values="row1,row2"} {$file->id}">
		
			{if $file->is_dir}
			<td class="pagepos" style="width:{$gbfp_thumb_width}px">{$file->fileicon}</td>
			<td>
				<a title="{$file->relurl}" style="padding:0.8em;display:block" href="{$file->fileurl}" onclick="GBFP.loadDir(this.href,'{$gbfp_cssid}','{$file->relurl}'); return false;">
					{$file->basename}
				</a>
			</td>
			
				{if $gbfp_media_type=='file'}
			<td>&nbsp;</td>
				{/if}
			
			<td>&nbsp;</td>
			
			<td class="pagepos">
				{if $gbfp_delete && isset($file->deleteurl)}
				<a href="{$file->deleteurl}" onclick="GBFP.deleteFile(this.href,'{$file->confirmdelete}', '{$file->relurl}'); return false;">
					{$gbfp_deleteicon}
				</a>
				{/if}
			</td>
			
			{else}
			
			<td class="pagepos" style="width:{$gbfp_thumb_width}px">
				{if $file->is_image && $file->thumbnail}
				<div class="GBFP_thumbnail_wrapper">
					<a title="{$file->relurl}" id="{$file->id}" href='{$file->fullurl}' onclick="{if $file->is_image && $file->thumburl}GBFP.toggleThumbnail('{$gbfp_cssid}','{$file->thumburl}','{$file->relurl}', '{$file->relurl}');{/if}GBFP.pickFile('{$file->relurl}', '{$gbfp_cssid}'); return false;">
						
						{$file->thumbnail}
						
					</a>
				</div>
				{else}
					{$file->fileicon}
				{/if}
			</td>
			<td>
				<a {if $file->is_image && $file->thumbnail}style="padding:0.8em;display:block;line-height:{$gbfp_thumb_height}px;"{/if} title="{$file->basename}" href='{$file->fullurl}' onclick="{if $file->is_image && $file->thumburl}GBFP.toggleThumbnail('{$gbfp_cssid}','{$file->thumburl}','{$file->relurl}', '{$file->relurl}');{/if}GBFP.pickFile('{$file->relurl}', '{$gbfp_cssid}'); return false;">
					{$file->basename}
				</a>
				
			</td>
			
				{if $gbfp_media_type=='file'}
			<td>{$file->filetype}</td>
				{/if}
				
			<td align="right" style="text-align:right;white-space: nowrap;line-height:130%">
				{$file->filesize}
				{if $file->is_image}
				<br />{$file->imgsize}
				{/if}
			</td>
			
			<td class="pagepos" align="right">
				{if $gbfp_delete && isset($file->deleteurl)}
				<a href="{$file->deleteurl}" onclick="GBFP.deleteFile(this.href,'{$file->confirmdelete}', '{$file->relurl}'); return false;">
					{$gbfp_deleteicon}
				</a>
				{/if}
			</td>
			
			{/if}
		</tr>
		{/foreach}
		</tbody>
	</table>
	{/if}
</div>
{/if}

{/strip}
