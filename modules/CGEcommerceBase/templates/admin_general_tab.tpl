{$formstart}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('currency_symbol')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}currency_symbol" value="{$currency_symbol}" size="4" maxlength="4"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('currency_code')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}currency_code" value="{$currency_code}" size="4" maxlength="4"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('weight_units')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}weight_units" value="{$weight_units}" size="4" maxlength="4"/>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('length_units')}:</p>
  <p class="pageinput">
    <select name="{$actionid}length_units">
    {html_options options=$units selected=$length_units}
    </select>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
  </p>
</div>
{$formend}