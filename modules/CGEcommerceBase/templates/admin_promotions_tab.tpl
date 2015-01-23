{$formstart}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('promotions_module')}:</p>
  <p class="pageinput">
    <select name="{$actionid}promotions_module">
    {html_options options=$promotions_modules selected=$promotions_module}
    </select>
    <br/>
    {$mod->Lang('info_promotions_module')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
  </p>
</div>
{$formend}