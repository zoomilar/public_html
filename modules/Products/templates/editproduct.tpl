<link rel="stylesheet" href="../modules/Products/lib/jquery.datepick.css" type="text/css"  />
<script type = "text/javascript" src = "../modules/Products/lib/jquery.datepick.js" ></script>	


<script src="{root_url}/modules/Products/products.js" type="text/javascript"></script>
<script src="{root_url}/modules/Products/lib/uploader/js/plupload.full.min.js" type="text/javascript"></script>
<script src="{root_url}/js/tx.preloader.js" type="text/javascript"></script>
<!-- debug 
<script type="text/javascript" src="{root_url}/modules/Products/lib/uploader/js/moxie.js"></script>
<script type="text/javascript" src="{root_url}/modules/Products/lib/uploader/js/plupload.dev.js"></script>
-->
{literal}
<script type="text/javascript">
var root_url = '{/literal}{root_url}{literal}';
jQuery(document).ready(function(){
	jQuery('.fancybox').fancybox();
});
var product_id = '{/literal}{if isset($compid)}{$compid}{else}{$compid_tmp}{/if}{literal}';
var delete_image = '{/literal}{$mod->lang("delete_image")}{literal}';
var textarea_multi_delete = '{/literal}{$mod->lang("textarea_multi_delete")}{literal}';
var nonamegiven = '{/literal}{$mod->lang("nonamegiven")}{literal}';
var name_field = '{/literal}{$product_name_field}{literal}';
</script>
{/literal}

{$startform}
{*if isset($compid)}
	<div class="pageoverflow">
		<p class="pagetext">{$idtext}:</p>
		<p class="pageinput">{$compid}</p>
	</div>
{/if*}
{if isset($compid_h_tmp)}
	{$compid_h_tmp}
{/if}
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$hidden}{$submit}{$apply}{$cancel}</p>
	</div>
{$starttabheaders}
{$tabheader_main}
{*if $customfieldscount gt 0}{$tabheader_fields}{/if*}
{$tabheader_advanced}
{$endtabheaders}

{$starttabcontent}
{$tab_main}
	<div class="pageoverflow" style="display: none">
		<p class="pagetext">*{$nametext}:</p>
		<p class="pageinput">{$inputname}</p>
	</div>
	{*<div class="pageoverflow">
		<p class="pagetext">{$pricetext}:</p>
		<p class="pageinput">{$currency_symbol}{$inputprice}<br/>
	          {$mod->Lang('info_decimal_units')}</p>
	</div>*}

	{*<div class="pageoverflow">
		<p class="pagetext">{$detailstext}:</p>
		<p class="pageinput">{$inputdetails}</p>
	</div>*}

	{* the hierarchy stuff *}
	{if count($hierarchy_items)}
	<div class="pageoverflow hierarchy_select">
          <p class="pagetext">{$mod->Lang('hierarchy_position')}:</p>
          <p class="pageinput">{$mod->CreateInputDropdown($actionid,'hierarchy',$hierarchy_items,'-1',$hierarchy_pos)}</p>
	                  
	</div>
        {/if}

	{* taxable? *}
	{*<div class="pageoverflow">
		<p class="pagetext">{$taxabletext}:</p>
	        <p class="pageinput">{$inputtaxable}</p>
	</div>*}
	
        {* categories *}
        {*if isset($input_categories)}
        <div class="pageoverflow">
           <p class="pagetext">{$mod->Lang('categories')}</p>
           <p class="pageinput">{$input_categories}</p>
        </div>
        {/if*}


{*$endtab*}

{* display custom fields *}
{if $customfieldscount gt 0}
{*$tab_fields*}
	
  {foreach from=$customfields item=customfield}
	
	<div class="pageoverflow">
		<p class="pagetext">{if isset($customfield->prompt)}{$customfield->prompt}{else}{$customfield->name}{/if}:
		{if $customfield->name == "facebookgalerija"}
			(<a href="/images/facebook_instr.jpg" target="_blank">paaiškinimas</a>)
		{/if}
		</p>
		<p class="pageinput {$customfield->group}">
			{if $customfield->type == 'image'}
				<script type="text/javascript">
					{literal}
					
					$(document).ready(function (e) {
						get_current_files({/literal}{$customfield->id}{literal}, {/literal}{if isset($compid)}{$compid}{else}'{$compid_tmp}'{/if}{literal});
						init_the_uploader({/literal}{$customfield->id}{literal}, {/literal}{if isset($compid)}{$compid}{else}'{$compid_tmp}'{/if}{literal});
					});
					
					{/literal}
				</script>
				<div id="currentfilelist_{$customfield->id}" class="file_block"></div>
				<div id="filelist_{$customfield->id}"></div>
				<div id="container_{$customfield->id}">
					<a id="pickfiles_{$customfield->id}">{$mod->Lang('pick_files')}</a>
				</div>
				 {if isset($customfield->hidden)}{$customfield->hidden}{/if}
			{else}
                {if isset($customfield->value)}
                  {if $customfield->type == 'image' && isset($customfield->image) && isset($customfield->thumbnail)}
                     <a href="{$customfield->image}" class="fancybox"><img src="{$customfield->thumbnail}" alt="{$customfield->value}"/></a>
                  {elseif $customfield->type != 'textarea' && $customfield->type != 'textarea_multi' && $customfield->type != 'checkboxgroup' && $customfield->type != 'dimensions' && $customfield->requ_lang != 1}{$mod->Lang('current_value')}:&nbsp;{$customfield->value}<br/>
                  {/if}

                  {if isset($customfield->delete)}{$mod->Lang('delete')}&nbsp;{$customfield->delete}<br/>{/if}
                {/if}         
                {if isset($customfield->hidden)}{$customfield->hidden}{/if}{$customfield->input_box}
                {if isset($customfield->attribute)}<br/>{$customfield->attribute}{/if}
                </p>
			{/if}
	</div>
  {/foreach}

{/if}



{$endtab}


{$tab_advanced}

	<div class="pageoverflow">
		<p class="pagetext">{$statustext}:</p>
		<p class="pageinput">{$inputstatus}</p>
	</div>

	<div class="pageoverflow" style="display:none">
		<p class="pagetext">{if $mod->GetPreference('skurequired')}*{/if}{$mod->Lang('sku')}:</p>
		<p class="pageinput">{$inputsku}</p>
	</div>
	<div class="pageoverflow" style="display:none">
		<p class="pagetext">{$weighttext} ({$weightunits}):</p>
		<p class="pageinput">{$inputweight}<br/>
                  {$mod->Lang('info_decimal_units')}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('url_alias')}:</p>
		<p class="pageinput">{$inputalias}</p>
	</div>
{$endtab}

{$endtabcontent}
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$hidden}{$submit}{$apply}{$cancel}</p>
	</div>
{$endform}
