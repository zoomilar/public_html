{$formstart}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('cart_module')}:</p>
  <p class="pageinput">
    <select name="{$actionid}cart_module">
    {html_options options=$cart_modules selected=$cart_module}
    </select>
    <br/>
    {$mod->Lang('info_cart_module')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
  </p>
</div>
{$formend}