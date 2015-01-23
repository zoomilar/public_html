{if isset($hierarchy_id)}
<h3>{$mod->Lang('edit_hierarchy_item')}</h3>
{else}
<h3>{$mod->Lang('add_hierarchy_item')}</h3>
{/if}
<script type="text/javascript" src="/modules/Products/scripts/cars.js"></script> 
<link rel="stylesheet" type="text/css" href="/modules/Products/css/products.css" media="screen" />

{$formstart}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('name')}</p>
   <div class="pageinput">
	{$name}
  </div>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('foto')}</p>
  
  <p class="pageinput">{if $image}Nuotrauka:&nbsp;{$image}<br/>{/if}{$mod->CreateFileUploadInput($actionid,'image')}{if $image}{$mod->CreateInputCheckbox($actionid,'deleteimg')}{/if}</p>
</div>



{*
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('miestas')}</p>
  <p class="pageinput">{$mod->CreateInputDropdown($actionid,'miestas',$miestai,'-1',$miestas)}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('googlekoo')}</p>
  <p class="pageinput"><input type="text" name="{$actionid}googlekoo" value="{$googlekoo}" size="50" maxlength="255"></p>
</div>
*}
{*}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('ppldinfo')}</p>
  <div class="pageinput">
	{$description}
  </div>
</div>
{*}

{*}<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('news')}</p>
  <div class="pageinput">
	{$news}
  </div>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('gal_data')}</p>
  <div class="pageinput">
	{$vnt}
  </div>
</div>{*}

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('parent')}</p>
  <p class="pageinput">{$mod->CreateInputDropdown($actionid,'parent',$hierarchy_items,'-1',$parent)}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput"><input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}">&nbsp;<input type="submit" name="{$actionid}cancel" value="{$mod->Lang('cancel')}"></p>
</div>
{$formend}