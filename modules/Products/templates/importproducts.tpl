{* import products form *}
<h3>{$mod->Lang('import_from_csv')}</h3>

{$formstart}
{if isset($messages)}

<div class="pageoverflow">
<div style="overflow: auto; height: 10em; width: 75%; margin-left: 5em; border: 1px dashed #ccc;"/>
{strip}
{foreach from=$messages item='one'}
  {$one}<br/>
{/foreach}
{/strip}
</div>
</div>

{elseif isset($errors)}
<div class="pageoverflow">
<div style="overflow: auto; height: 10em; width: 75%; margin-left: 5em; border: 1px dashed #ccc;"/>
{strip}
{foreach from=$errors item='one'}
  {$one}<br/>
{/foreach}
{/strip}
</div>
</div>
{/if}

{if !isset($csvfile)}
{* display the form *}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_delimiter')}</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}delimiter" value="{$delimiter}" size="5" maxlength="10"/>
    <br/>
    {$mod->Lang('info_delimiter')}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_createfields')}</p>
  <p class="pageinput">
    <select name="{$actionid}createfields">
      {html_options options=$yesno selected=$flag_createfields}
    </select>
    <br/>
    {$mod->Lang('info_createfields')}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_handleimages')}</p>
  <p class="pageinput">
    <select name="{$actionid}handleimages">
      {html_options options=$yesno selected=$flag_handleimages}
    </select>
    <br/>
    {$mod->Lang('info_handleimages')}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_imagepath')}</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}imagepath" value="{$imagepath}" size="60"/>
    <br/>
    {$mod->Lang('info_imagepath')}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_createhierarchy')}</p>
  <p class="pageinput">
    <select name="{$actionid}createhierarchy">
      {html_options options=$yesno selected=$flag_createhierarchy}
    </select>
    <br/>
    {$mod->Lang('info_createhierarchy')}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_createcategories')}</p>
  <p class="pageinput">
    <select name="{$actionid}createcategories">
      {html_options options=$yesno selected=$flag_createcategories}
    </select>
    <br/>
    {$mod->Lang('info_createcategories')}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_duplicateproducts')}</p>
  <p class="pageinput">
    <select name="{$actionid}duplicateproducts">
       <option label="{$mod->Lang('label_skip')}" value="skip" {if $flag_duplicateproducts eq "skip"}selected="selected"{/if}>{$mod->Lang('label_skip')}</option>
       <option label="{$mod->Lang('label_update')}" value="update" {if $flag_duplicateproducts eq "update"}selected="selected"{/if}>{$mod->Lang('label_update')}</option>
       <option label="{$mod->Lang('label_overwrite')}" value="overwrite" {if $flag_duplicateproducts eq "overwrite"}selected="selected"{/if}>{$mod->Lang('label_overwrite')}</option>
    </select>
    <br/>
    {$mod->Lang('info_duplicateproducts')}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_batchsize')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}batchsize" value="{$batchsize}" size="3" maxlength="3"/>
    <br/>
    {$mod->Lang('info_batchsize')}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_clearfields')}:</p>
  <p class="pageinput">
    {cge_yesno_options prefix=$actionid name=clearfields selected=$clearfields}
    <br/>{$mod->Lang('info_clearfields')}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_clearattribs')}:</p>
  <p class="pageinput">
    {cge_yesno_options prefix=$actionid name=clearattribs selected=$clearattribs}
    <br/>{$mod->Lang('info_clearattribs')}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_clearcategories')}:</p>
  <p class="pageinput">
    {cge_yesno_options prefix=$actionid name=clearcategories selected=$clearcategories}
    <br/>{$mod->Lang('info_clearcategories')}
  </p>
</div>

{/if}

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_csvfile')}</p>
  <p class="pageinput">
    {if isset($csvfile)}
    <input type="text" name="{$actionid}csvfile" value="{$csvfile}" readonly=readonly/>
    {else}
    <input type="file" name="{$actionid}csvfile" value="" size="60"/>
    {/if}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">
    {if isset($csvfile)}
    <input type="submit" name="{$actionid}go" value="{$mod->Lang('go')}" onclick="return confirm('{$mod->Lang('confirm_import')}');"/>
    {else}
    <input type="submit" name="{$actionid}test" value="{$mod->Lang('test')}"/>
    {/if}
    <input type="submit" name="{$actionid}cancel" value="{$mod->Lang('cancel')}"/>
  </p>
</div>
{$formend}