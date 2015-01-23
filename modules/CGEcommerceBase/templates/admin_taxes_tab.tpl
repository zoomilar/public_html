{$formstart}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('tax_module')}:</p>
  <p class="pageinput">
    <select name="{$actionid}tax_module">
    {html_options options=$tax_modules selected=$tax_module}
    </select>
    <br/>
    {$mod->Lang('info_tax_module')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('tax_shipping')}:</p>
  <p class="pageinput">
    {cge_yesno_options prefix=$actionid name=tax_shipping selected=$tax_shipping}
    <br/>
    {$mod->Lang('info_tax_shipping')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
  </p>
</div>
{$formend}