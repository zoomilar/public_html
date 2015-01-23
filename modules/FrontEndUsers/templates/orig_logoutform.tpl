{* logout form template *}
{if isset($message)}<div class="message">{$message}</div>{/if}
<p>{$prompt_loggedin}&nbsp;{$username}</p> 
<p><a href="{$url_changesettings}" title="{$mod->Lang('info_changesettings')}">{$mod->Lang('prompt_changesettings')}</p>
<p><a href="{$url_logout}" title="{$mod->Lang('info_logout')}">{$mod->Lang('logout')}</a></p>
