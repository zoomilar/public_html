{* login form template *}
{* this is a sample template, feel free to customize it *}
{$startform}
<div id="loginform">
{if $error}
  {$error}<br>
{/if}
<p><label for="{$feuactionid}feu_input_username">{$prompt_username}:</label>&nbsp;{$input_username}<br/></p>
<p><label for="{$feuactionid}feu_input_password">{$prompt_password}:</label>&nbsp;{$input_password}</p>
{if isset($captcha)}<p>
  <label for="{$feuactionid}input_captcha">{$captcha_title}:</label>&nbsp;{$input_captcha}<br/>{$captcha}</p>
{/if}
{if isset($input_rememberme)}<p>{$input_rememberme}&nbsp;<label for="{$feuactionid}feu_rememberme">{$prompt_rememberme}</input></p>{/if}
<p><input type="submit" name="{$feuactionid}submit" value="{$mod->Lang('login')}"/></p>
<p><a href="{$url_forgot}" title="{$mod->Lang('info_forgotpw')}">{$mod->Lang('forgotpw')}</a>&nbsp;
<a href="{$url_lostun}" title="{$mod->Lang('info_lostun')}">{$mod->Lang('lostusername')}</a></p>
</div>
{$endform}