{* logout form template *}
{*
{if isset($message)}<div class="message">{$message}</div>{/if}
<p>{$prompt_loggedin}&nbsp;{$username}</p> 
<p><a href="{$url_changesettings}" title="{$mod->Lang('info_changesettings')}">{$mod->Lang('prompt_changesettings')}</p>
<p><a href="{$url_logout}" title="{$mod->Lang('info_logout')}">{$mod->Lang('logout')}</a></p>

*}

<div class="login_block">
	{$startform}
		<a href="{$url_logout}" class="ext_button brown f_12">
			<span>{#do_logout#}</span>
		</a>
	{$endform}
</div>
