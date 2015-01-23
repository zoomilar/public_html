{strip}
{*------------------------------------------------------------------------------

Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
         a content management tool for CMS Made Simple
         The projects homepage is http://dev.cmsmadesimple.org/projects/content2
         CMS Made Simple is (c) 2004-2013 by Ted Kulp (wishy@cmsmadesimple.org)
         The projects homepage is: http://www.cmsmadesimple.org
Version: 0.9.4
File   : header.tpl
License: GPL

------------------------------------------------------------------------------*}

<!-- start ac head -->

{literal}
<style type="text/css">
.ac_contract {
	background-image: url("{/literal}{$contract_img}{literal}") !important;
}
.ac_expand {
	background-image: url("{/literal}{$expand_img}{literal}") !important;
}
</style>
<script language="javascript" type="text/javascript">
/* <![CDATA[ */
var ac_onload = [
	function(){
		jQuery(document).ready(function(){
			jQuery(".ac_block_tabs").tabs();
			jQuery.datepicker.setDefaults( jQuery.datepicker.regional[ '{/literal}{$locale}{literal}' ] );
			jQuery( "#AdvancedContentStartDatePickerDisplay" ).datepicker({
				numberOfMonths: 3,
				showButtonPanel: true,
				showOn: "button",
				buttonImage: "{/literal}{root_url}{literal}/modules/AdvancedContent/images/calendar.png",
				altField: "#AdvancedContentStartDate",
				altFormat: "@",
				buttonImageOnly: true
			});
			jQuery( "#AdvancedContentEndDatePickerDisplay" ).datepicker({
				numberOfMonths: 3,
				showButtonPanel: true,
				showOn: "button",
				buttonImage: "{/literal}{root_url}{literal}/modules/AdvancedContent/images/calendar.png",
				altField: "#AdvancedContentEndDate",
				altFormat: "@",
				buttonImageOnly: true
			});
			jQuery('#ui-datepicker-div').removeClass('ui-helper-hidden-accessible');
		});
	}
];
/* ]]> */
</script>
{/literal}
<link rel="stylesheet" media="screen" type="text/css" href="{root_url}/modules/AdvancedContent/css/style.css" />

{if isset($jq_ui_css)}
	<link rel="stylesheet" media="screen" type="text/css" href="{$jq_ui_css}" />
{/if}
{if isset($bc)}
<script language="javascript" type="text/javascript" src="{root_url}/modules/AdvancedContent/js/jq.jq-ui.js" defer="true"></script>
{/if}
<script language="javascript" type="text/javascript" src="{root_url}/modules/AdvancedContent/js/main.js" defer="true"></script>

{if isset($locale)}
	{capture assign="lang_js"}{root_url}/modules/AdvancedContent/js/jquery-ui/datepicker/lang/jquery.ui.datepicker-{$locale}.js{/capture}
	{if is_file($lang_js)}

<script language="javascript" type="text/javascript" src="{root_url}/modules/AdvancedContent/js/jquery-ui/datepicker/lang/jquery.ui.datepicker-{$locale}.js" defer="true"></script>

	{else}

<script language="javascript" type="text/javascript" src="{root_url}/modules/AdvancedContent/js/jquery-ui/datepicker/lang/jquery.ui.datepicker-en-GB.js" defer="true"></script>

	{/if}
{/if}

{if isset($content_obj) && $content_obj->Type() == 'content2'}
	
	<div class="pageoverflow pageerrorcontainer ac_page_errormessage">
		<p>The contenttype class "Content2" is deprecated. Use the new class "advanced_content" instead.</p>
	</div>
	
{/if}

<!-- end ac head -->

{/strip}
