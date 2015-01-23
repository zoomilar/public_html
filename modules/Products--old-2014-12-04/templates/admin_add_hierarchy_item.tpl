<link type="text/css" href="{root_url}/modules/Products/js/ui.multiselect.css" rel="stylesheet" />
<script type="text/javascript" src="{root_url}/modules/Products/js/ui.multiselect.js"></script>
<script src="{root_url}/modules/Products/products.js" type="text/javascript"></script>
<script type="text/javascript">{literal}

var $addall = '{/literal}{$mod->Lang("multiselect_addall")}{literal}';
var $remall = '{/literal}{$mod->Lang("multiselect_remall")}{literal}';
var $ieskoti = '{/literal}{$mod->Lang("multiselect_ieskoti")}{literal}';

$(document).ready(function(){
  $('a.popup_image').fancybox();
  
	if($.isFunction($.fn.multiselect)) {
		$(".superselect select").multiselect({
			'sortable': true
		});
	}
});
{/literal}</script>
{if isset($hierarchy_id)}
<h3>{$mod->Lang('edit_hierarchy_item')}</h3>
{else}
<h3>{$mod->Lang('add_hierarchy_item')}</h3>
{/if}

{$formstart}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('name')}</p>
  <p class="pageinput">{$name}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('vidine_nuoroda')}</p>
  <p class="pageinput">{$redirect_to}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('parent')}</p>
  <p class="pageinput">{$mod->CreateInputDropdown($actionid,'parent',$hierarchy_items,'-1',$parent)}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('description')}</p>
  <p class="pageinput">
	{$description}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('show_hier_page')}</p>
  <p class="pageinput">
	{$show_hier_page}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('extra1')}</p>
  <p class="pageinput">{$extra1}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('imagetext')}</p>
  <p class="pageinput">
     {if isset($image) && !empty($image) && $image != '0'}{$mod->Lang('current_value')}:&nbsp;<a class="popup_image" href="{$image_url}">{$image}</a><br/>
       {$mod->Lang('delete')}:<input type="checkbox" name="{$mod->GetActionId()}deleteimg" value="1"><br/>
     {/if}
     <input type="file" name="{$actionid}file" size="50" maxlength="255">
     {if isset($watermark_location)}
       <br/>
       {$mod->Lang('watermark_location')}:&nbsp;{$watermark_location}
     {/if}
  </p>
</div>
{*
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('extra2')}</p>
  <p class="pageinput"><input type="text" name="{$actionid}extra2" value="{$extra2}" size="50" maxlength="255"></p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('name2')}</p>
  <p class="pageinput">{$name2}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('description2')}</p>
  <p class="pageinput">
	{$description2}
  </p>
</div>*}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('imagetext2')}</p>
  <p class="pageinput">
     {if isset($image2) && !empty($image2) && $image2 != '0'}{$mod->Lang('current_value')}:&nbsp;<a class="popup_image" href="{$image_url2}">{$image2}</a><br/>
       {$mod->Lang('delete')}:<input type="checkbox" name="{$mod->GetActionId()}deleteimg2" value="1"><br/>
     {/if}
     <input type="file" name="{$actionid}file2" size="50" maxlength="255">
     {if isset($watermark_location)}
       <br/>
       {$mod->Lang('watermark_location')}:&nbsp;{$watermark_location}
     {/if}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('filetext')}</p>
  <p class="pageinput">
     {if isset($file) && !empty($file) && $file != '0'}{$mod->Lang('current_value')}:&nbsp;<a target="_blank" href="{$file_url}">{$file}</a><br/>
       {$mod->Lang('delete')}:<input type="checkbox" name="{$mod->GetActionId()}deletefile" value="1"><br/>
     {/if}
     <input type="file" name="{$actionid}file4" size="50" maxlength="255">
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('hierfields')}</p>
  <p class="pageinput superselect">
	{$hierfield}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('hierfields2')}</p>
  <p class="pageinput superselect">
	{$hierfield2}
  </p>
</div>


<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput"><input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}">&nbsp;<input type="submit" name="{$actionid}cancel" value="{$mod->Lang('cancel')}"></p>
</div>
{$formend}