{$formstart}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('payment_module')}:</p>
  <p class="pageinput">
    <select name="{$actionid}payment_module">
    {html_options options=$payment_modules selected=$payment_module}
    </select>
    <br/>
    {$mod->Lang('info_payment_module')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
  </p>
</div>
{$formend}