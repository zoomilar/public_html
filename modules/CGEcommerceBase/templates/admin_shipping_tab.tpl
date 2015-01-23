{$formstart}
<input type="hidden" name="{$actionid}cg_activetab" value="shipping">{* a little trick for the tab *}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('shipping_module')}:</p>
  <p class="pageinput">
    <select name="{$actionid}shipping_module">
    {html_options options=$shipping_modules selected=$shipping_module}
    </select>
    <br/>
    {$mod->Lang('info_shipping_module')}
  </p>
</div>


<div class="pageoverflow">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input type="submit" name="{$actionid}shipping_submit" value="{$mod->Lang('submit')}"/>
  </p>
</div>
{$formend}