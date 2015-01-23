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
{if isset($gbfp_errormessage) && $gbfp_errormessage!=""}
	<fieldset class="GBFP_message" id="GBFP_error">
		<legend>{$gbfp_error_text}</legend>
		{$gbfp_errormessage}
	</fieldset>
{/if}
{if isset($gbfp_message) && $gbfp_message!=""}
	<fieldset class="GBFP_message" id="GBFP_success">
		<legend>{$gbfp_success_text}</legend>
		{$gbfp_message}
	</fieldset>
{/if}
{if isset($gbfp_formstart)}
	<fieldset>
{$gbfp_formstart}
		<div style="float:left;margin-right:5%">
			<p>{$gbfp_fileupload_text}:</p>
			<p>{$gbfp_fileupload_input}</p>
	{if $gbfp_allow_scaling}
			<p>{$gbfp_resizeimage_text}:&nbsp;{$gbfp_resizeimage_input}</p>
			<p>{$gbfp_imagesize_x_input}&nbsp;x&nbsp;{$gbfp_imagesize_y_input}</p>
			<p>{$gbfp_keepaspectratio_text}:&nbsp;{$gbfp_keepaspectratio_input}</p>
			{if $gbfp_allow_upscaling}
			<p>{$gbfp_forceupscaling_text}:&nbsp;{$gbfp_forceupscaling_input}</p>
			{/if}
	{/if}
			<p>{$gbfp_fileupload_submit}</p>
		</div>
{$gbfp_formend}
	</fieldset>
{/if}
</div>
{/strip}
