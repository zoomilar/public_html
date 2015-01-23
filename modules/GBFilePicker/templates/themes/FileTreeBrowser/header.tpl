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
<script language="javascript" type="text/javascript">
GBFP_rootUrl = "{/literal}{root_url}{literal}/modules/GBFilePicker";
GBFP_fileTreeBrowser_onload = [];
if(typeof jsLoader_scripts == 'undefined')
	jsLoader_scripts = [];
jsLoader_scripts.push({
	url:'{/literal}{root_url}{literal}/modules/GBFilePicker/templates/themes/FileTreeBrowser/js/jq.ui.fileTreeBrowser.js', 
	loadType:'defer'
});
</script>
{/literal}
<link rel="stylesheet" media="screen" type="text/css" href="{root_url}/modules/GBFilePicker/templates/themes/FileTreeBrowser/css/fileTreeBrowser.css" />
{gbfp_jsloader}
<!-- end gbfp head -->

{/strip}
