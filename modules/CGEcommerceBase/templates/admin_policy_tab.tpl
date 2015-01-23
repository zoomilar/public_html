<p class="pageoverflow">
{$mod->Lang('info_cart_policy')}

<fieldset>
<legend>{$mod->Lang('system_policy')}:</legend>
{$formstart}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('max_products')}:</p>
  <p class="pageinput">
    <select name="{$actionid}policy_maxproducts">
    {html_options options=$num_options selected=$syspolicy->max_products()}
    </select>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('max_services')}:</p>
  <p class="pageinput">
    <select name="{$actionid}policy_maxservices">
    {html_options options=$num_options selected=$syspolicy->max_services()}
    </select>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('max_subscriptions')}:</p>
  <p class="pageinput">
    <select name="{$actionid}policy_maxsubscriptions">
    {html_options options=$num_options selected=$syspolicy->max_subscriptions()}
    </select>
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('mixed_subscriptions')}:</p>
  <p class="pageinput">
    {cge_yesno_options prefix=$actionid name='policy_mixedsubscriptions' selected=$syspolicy->handle_mixed_subscriptions()}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
  </p>
</div>
{$formend}
</fieldset>

<fieldset>
<legend>{$mod->Lang('gateway_policy')}</legend>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('max_products')}:</p>
  <p class="pageinput">
    {assign var='tmp' value=$paypolicy->max_products()}
    {$num_options[$tmp]}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('max_services')}:</p>
  <p class="pageinput">
    {assign var='tmp' value=$paypolicy->max_services()}
    {$num_options[$tmp]}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('max_subscriptions')}:</p>
  <p class="pageinput">
    {assign var='tmp' value=$paypolicy->max_subscriptions()}
    {$num_options[$tmp]}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('mixed_subscriptions')}:</p>
  <p class="pageinput">
   {if $paypolicy->handle_mixed_subscriptions()}
     {$mod->Lang('yes')}
   {else}
     {$mod->Lang('no')}
   {/if}
  </p>
</div>
</fieldset>