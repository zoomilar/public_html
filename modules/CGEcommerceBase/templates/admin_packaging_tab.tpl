{$formstart}
<input type="hidden" name="{$actionid}cg_activetab" value="packaging">{* a little trick for the tab *}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('packaging_module')}:</p>
  <p class="pageinput">
    <select name="{$actionid}packaging_module">
    {html_options options=$packaging_modules selected=$packaging_module}
    </select>
    <br/>
    {$mod->Lang('info_packaging_module')}
  </p>
</div>

{if isset($products_checkboxes)}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('ship_seperately_field')}:</p>
  <p class="pageinput">
    <select name="{$actionid}ship_seperately">
    {html_options options=$products_checkboxes selected=$ship_seperately}
    </select>
    <br/>
    {$mod->Lang('info_ship_seperately')}
  </p>
</div>
{/if}

{if isset($products_dimensions)}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('ship_dimensions_field')}:</p>
  <p class="pageinput">
    <select name="{$actionid}ship_dimensions">
    {html_options options=$products_dimensions selected=$ship_dimensions}
    </select>
    <br/>
    {$mod->Lang('info_ship_dimensions')}
  </p>
</div>
{/if}

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('prompt_overweight_limit')} ({$weight_units}):</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}overweight_limit" size="5" maxlength="5" value="{$shipping_profile->get_overweight_limit()|number_format:2}"/>
    <br/>
    {$mod->Lang('info_overweight_limit')}
  </p>
</div>

<fieldset style="width: 50%; float: left;">
<legend>{$mod->Lang('prompt_shipping_boxes')}:</legend>
{assign var='boxes' value=$shipping_profile->get_boxes()}
<table>
  <thead>
  <tr>
    <td>{$mod->Lang('prompt_name')}</td>
    <td>{$mod->Lang('prompt_width')}({$length_units}))</td>
    <td>{$mod->Lang('prompt_height')}({$length_units}))</td>
    <td>{$mod->Lang('prompt_length')}({$length_units}))</td>
    <td>{$mod->Lang('prompt_maxweight')}({$weight_units}))</td>
    <td>{$mod->Lang('prompt_sorting')}</td>
  </tr>
  </thead>
  </tbody>
  {foreach from=$boxes item='box'}
  <tr>
    <td><input type="text" name="{$actionid}box_name[{$box.name}]" size="20" maxlength="20" value="{$box.name}"/></td>
    <td><input type="text" name="{$actionid}box_width[{$box.name}]" size="4" maxlength="4" value="{$box.width|number_format:2}"/></td>
    <td><input type="text" name="{$actionid}box_height[{$box.name}]" size="4" maxlength="4" value="{$box.height|number_format:2}"/></td>
    <td><input type="text" name="{$actionid}box_length[{$box.name}]" size="4" maxlength="4" value="{$box.length|number_format:2}"/></td>
    <td><input type="text" name="{$actionid}box_weight[{$box.name}]" size="4" maxlength="4" value="{$box.weight|number_format:2}"/></td>
    <td><input type="text" name="{$actionid}box_score[{$box.name}]" size="4" maxlength="4" value="{$box.score}"/></td>
  </tr>
  {/foreach}
  </tbody>
</table>
</fieldset>


<div class="pageoverflow">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input type="submit" name="{$actionid}packaging_submit" value="{$mod->Lang('submit')}"/>
  </p>
</div>
{$formend}