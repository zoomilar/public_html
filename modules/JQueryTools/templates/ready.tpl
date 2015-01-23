{* here we set default values and attributes for the libs that are loaded. *}
{capture assign='out'}{strip}
{if isset($jquery_libs.tablesorter)}
jQuery(".cms_sortable").tablesorter({ widthFixed: true, widgets: ['zebra'], sortList: [[0,0]] });
{/if}
{if isset($jquery_libs.ui)}
jQuery('div.accordion').accordion();
{/if}
{if isset($jquery_libs.lightbox)}
jQuery('a.lightbox').lightBox();
{/if}
{if isset($jquery_libs.fancybox)}
jQuery('a.fancybox').fancybox();
{/if}
{if isset($jquery_libs.cluetip)}
jQuery("a.tooltip").cluetip({ local:true, cursor: 'pointer' });
{/if}
{/strip}{/capture}
{if strlen($out)}
<!-- {$JQueryTools->GetName()} version {$JQueryTools->GetVersion()} -->
<script type="text/javascript">//<![CDATA[{jsmin}
jQuery(document).ready(function($) {
	{$out}
});  //end
{/jsmin}//]]></script>
{/if}