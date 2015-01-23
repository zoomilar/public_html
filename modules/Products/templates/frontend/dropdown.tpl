{*}
{foreach from=$items item=v name="tur"}
	<li><a href='{$v.url}'><span class='f1'>{$v.datash}&nbsp;&nbsp;{$v.savd}.<br/>&nbsp;</span><span class='f2'>{$v.pavadinimas2}</span></a></li>
{/foreach}
{*}

{foreach from=$items item=v name="tur"} 
	<li{if $t_kintamasis.1 == "Turnyrai" && $t_kintamasis.2 == $v.id} class="selected"{/if}><a href='{$v.url}' title='{$v.pavadinimas_pilnas}' {if !$mobtab}class="show_qtip3"{/if}>{$v.data}&nbsp;&nbsp;&nbsp;{$v.data|weekday:$kalba}</a></li>
{/foreach}