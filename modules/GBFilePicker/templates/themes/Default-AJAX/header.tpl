{strip}
{*------------------------------------------------------------------------------

  Module : GBFilePicker (c) 2010-2012 by Georg Busch (georg.busch@gmx.net)
           a filepicker tool for CMS Made Simple
           The projects homepage is dev.cmsmadesimple.org/projects/gbfilepicker
           CMS Made Simple is (c) 2004-2012 by Ted Kulp
           The projects homepage is: cmsmadesimple.org
  Version: 1.3.2
  File   : header.tpl
  License: GPL

------------------------------------------------------------------------------*}

<!-- start gbfp head -->

{literal}
<style type="text/css">
.gbfp_contract {
	background-image: url("{/literal}{$contract_img}{literal}") !important;
}
.gbfp_expand {
	background-image: url("{/literal}{$expand_img}{literal}") !important;
}
</style>
<script language="javascript" type="text/javascript">
gbfp_onload = [
	function(){
		GBFP.init({
			title: '{/literal}{$gbfp_title}{literal}',
			closeText: '{/literal}{$gbfp_close_text}{literal}',
			reloadText: '{/literal}{$gbfp_reload_dir_text}{literal}',
			clearCacheText: '{/literal}{$gbfp_clear_cache_text}{literal}',
			rootUrl: '{/literal}{root_url}{literal}',
			thumbnailWidth: {/literal}{$thumb_width}{literal},
			thumbnailHeight: {/literal}{$thumb_height}{literal},
			moduleId: '{/literal}{$gbfp_id}{literal}'
		});
	}
];
if(typeof jsLoader_scripts == 'undefined')
	jsLoader_scripts = [];
jsLoader_scripts.push({
	url:'{/literal}{root_url}{literal}/modules/GBFilePicker/templates/themes/Default-AJAX/js/GBFP.js', 
	loadType:'defer'
});
</script>
{/literal}
<link rel="stylesheet" media="screen" type="text/css" href="{root_url}/modules/GBFilePicker/templates/themes/Default-AJAX/css/GBFP.css" />
{gbfp_jsloader}

<!-- end gbfp head -->

{/strip}
