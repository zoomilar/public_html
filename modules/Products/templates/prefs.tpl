{$startform}
<fieldset>
<legend>{$mod->Lang('general_settings')}:</legend>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_urlprefix')}:</p>
  <p class="pageinput"><input type="text" name="{$actionid}urlprefix" size="20" maxlength="20" value="{$urlprefix}"/></p>
</div>
{if isset($input_currencysymbol)}
<div class="pageoverflow">
  <p class="pagetext">{$prompt_currencysymbol}:</p>
  <p class="pageinput">{$input_currencysymbol}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_weightunits}:</p>
  <p class="pageinput">{$input_weightunits}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_lengthunits}:</p>
  <p class="pageinput">{$input_lengthunits}</p>
</div>
{/if}

<div class="pageoverflow">
  <p class="pagetext">{$prompt_kalbos}:</p>
  <p class="pageinput">{$input_kalbos}</p>
</div>


{if $input_curency_field|@count > 0}
	{foreach from=$input_curency_field item="vll"}
		<div class="pageoverflow">
			<p class="pagetext">{$vll.name}:</p>
			<p class="pageinput">{$vll.value}</p>
		</div>
	{/foreach}
{/if}

{if $input_pvm_field|@count > 0}
	{foreach from=$input_pvm_field item="vll"}
		<div class="pageoverflow">
			<p class="pagetext">{$vll.name}:</p>
			<p class="pageinput">{$vll.value}</p>
		</div>
	{/foreach}
{/if}

{if $input_summary_page_field|@count > 0}
	{foreach from=$input_summary_page_field item="vll"}
		<div class="pageoverflow">
		<p class="pagetext">{$vll.name}:</p>
		<p class="pageinput">{$vll.value}</p>
		</div>
	{/foreach}
{/if}
{if $input_summary_page_names_field|@count > 0}
	{foreach from=$input_summary_page_names_field item="vll"}
		<div class="pageoverflow">
		<p class="pagetext">{$vll.name}:</p>
		<p class="pageinput">{$vll.value}</p>
		</div>
	{/foreach}
{/if}

{if $input_detail_page_field|@count > 0}
	{foreach from=$input_detail_page_field item="vll"}
		<div class="pageoverflow">
		<p class="pagetext">{$vll.name}:</p>
		<p class="pageinput">{$vll.value}</p>
		</div>
	{/foreach}
{/if}
{if $input_detail_page_names_field|@count > 0}
	{foreach from=$input_detail_page_names_field item="vll"}
		<div class="pageoverflow">
		<p class="pagetext">{$vll.name}:</p>
		<p class="pageinput">{$vll.value}</p>
		</div>
	{/foreach}
{/if}

{*
<div class="pageoverflow">
  <p class="pagetext">{$prompt_curency_field}:</p>
  <p class="pageinput">{$input_curency_field}</p>
</div>*}
<div class="pageoverflow">
  <p class="pagetext">{$prompt_pavadinimas_field}:</p>
  <p class="pageinput">{$input_pavadinimas_field}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_price_field}:</p>
  <p class="pageinput">{$input_price_field}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_empty_fields}:</p>
  <p class="pageinput">{$input_empty_fields}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_akcija_field}:</p>
  <p class="pageinput">{$input_akcija_field}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_laukeliu_grupes}:</p>
  <p class="pageinput">{$input_laukeliu_grupes}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input type="submit" name="{$actionid}setecomhandlers" value="{$mod->Lang('btn_setecomhandlers')}"/>
    <br/>
    {$mod->Lang('info_setecomhandlers')}
  </p>
</div>
</fieldset>

<fieldset>
<legend>{$mod->Lang('product_editing_settings')}:</legend>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_sku_required')}:</p>
  <p class="pageinput">
    {cge_yesno_options prefix=$actionid name='skurequired' selected=$skurequired}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_default_taxable')}:</p>
  <p class="pageinput">{$input_taxable}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_default_status')}:</p>
  <p class="pageinput">{$input_status}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_allowed_filetypes')}:</p>
  <p class="pageinput">{$input_allowed_filetypes}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_deleteproductfiles')}:</p>
  <p class="pageinput">{$input_deleteproductfiles}</p>
</div>
</fieldset>

<fieldset>
<legend>{$mod->Lang('product_summary_settings')}:</legend>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_summary_newdefault')}:</p>
  <p class="pageinput">
    {cge_yesno_options prefix=$actionid name='summary_newdefault' selected=$summary_newdefault}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_summarypagelimit')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}summary_pagelimit" size="5" maxlength="5" value="{$summary_pagelimit}"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_summarysortorder}:</p>
  <p class="pageinput">{$input_summarysortorder}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_summarysorting}:</p>
  <p class="pageinput">{$input_summarysorting}</p>
</div>
</fieldset>

<fieldset>
<legend>{$mod->Lang('product_detail_settings')}:</legend>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_usehierpathurls')}:</p>
  <p class="pageinput">
    {$input_usehierpathurls}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_detailpage}:</p>
  <p class="pageinput">{$input_detailpage}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_use_detailpage_for_search')}:</p>
  <p class="pageinput"> 
    {$input_use_detailpage_for_search}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_notfound_behavior')}:</p>
  <p class="pageinput">
    <select name="{$actionid}prodnotfound">
    {html_options options=$notfound_opts selected=$prodnotfound}
    </select>
    <br/>
    {$mod->Lang('info_prodnotfound')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_notfound_page')}:</p>
  <p class="pageinput">
    {$input_prodnotfoundpage}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_notfound_msg')}:</p>
  <p class="pageinput">
    <textarea name="{$actionid}prodnotfoundmsg" rows="5">{$prodnotfoundmsg}</textarea>
  </p>
</div>
</fieldset>

<fieldset>
<legend>{$mod->Lang('hierarchy_settings')}:</legend>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_hierpage')}:</p>
  <p class="pageinput">{$input_hierpage}<br/>
  {$mod->Lang('info_hierpage')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_prettyhierurls')}:</p>
  <p class="pageinput">{cge_yesno_options prefix=$actionid name='prettyhierurls' selected=$prettyhierurls}<br/>
  {$mod->Lang('info_prettyhierurls')}
  </p>
</div>
</fieldset>

<fieldset>
<legend>{$mod->Lang('image_handling_settings')}:</legend>
<p style="color: red;">{$mod->Lang('info_imagestuff_deprecated')}</p>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_allowed_imagetypes')}:</p>
  <p class="pageinput">{$input_allowed_imagetypes}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_autothumbnail')}:</p>
  <p class="pageinput">{$input_autothumbnail}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_autothumbnail_size')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}autothumbnail_size" size="5" maxlength="5" value="{$auto_thumbnail_size}"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_autopreviewimg')}:</p>
  <p class="pageinput">{$input_autopreviewimg}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_autopreviewimg_size')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}autopreviewimg_size" size="5" maxlength="5" value="{$auto_previewimg_size}"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_autowatermark')}:</p>
  <p class="pageinput">{$input_autowatermark}<br/>{$mod->Lang('info_autowatermark')}</p>
</div>
</fieldset>

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$submit}</p>
</div>

{$endform}