
<div class="pageoptions">
	<p class="pageoptions">{$addlink}</p>
</div>
<table cellspacing="0" class="pagetable">
	<thead>
		<tr>
			<th width="10px"><div>&nbsp;</div></th>
			<th width="20px"><div>{$Titulinis->Lang(sq)}</div></th>
			<th width="20px"><div>{$Titulinis->Lang(paveiksliukas)}</div></th>
			<th><div>{$Titulinis->Lang(pavadinimas)}</div></th>
			<th width="30px"><div>{$Titulinis->Lang(state)}</div></th>
			<th width="10px" class="pageicon"><div>{$Titulinis->Lang(istrinti)}</div></th>
		</tr>
	</thead>
{foreach from=$kalbos item=kalba key=kl}
	<tbody id='{$kalba}'>
			<tr><td colspan='9' style="background-color: #e5e5e5"><b>{*$kalba|upper*}</b></td></tr>
			{assign var='nmb' value='0'}
			{foreach from=$prop_array.$kl item=entry}
				{assign var='nmb' value=$nmb+1}
				<tr class="row1" onmouseover="this.className='row1hover';" onmouseout="this.className='row1';" id='lt-{$nmb}'>
					<td><div></div></td>
					<td style="text-align:center"><div>{$entry->eiliskumas}</div></td>
					<td>{if $entry->paveiksliukas}<div>{if $allow_more || ($cuser == $entry->userid)}<a href="moduleinterface.php?_sx_={$smarty.get._sx_}&mact={$mod_w},m1_,editprop,0&prop_id={$entry->id}&m1_kat={$kateg}" class="roo" id="r-{$entry->kategorija}-{$nmb}"><img style="width: 100px" src="{$root_url}/uploads/images/titulinis/{$entry->paveiksliukas}"/></a>{else}{$entry->paveiksliukas}{/if}</div>{/if}</td>	
					<td><div>{$entry->pavadinimas} {$entry->pavadinimas2} {$entry->pavadinimas3}</div></td>	
					<td><div>{if $entry->nerodyti}{$Titulinis->Lang(pasleptas)}{else}{$Titulinis->Lang(rodomas)}{/if}</div></td>					
					<td><div>{if $allow_edit || ($cuser == $entry->userid)}<a href="moduleinterface.php?_sx_={$smarty.get._sx_}&mact={$mod_w},m1_,editprop,0&prop_id={$entry->id}&m1_kat={$kateg}">edit</a>{/if}&nbsp;{if $allow_del == "yes" || ($cuser == $entry->userid)}|&nbsp;<a onclick="if(!confirm('ar tikrai?')) return false;" href="moduleinterface.php?_sx_={$smarty.get._sx_}&mact={$mod_w},m1_,deleteprop,0&prop_id={$entry->id}">delete</a>{/if}</div></td>
				</tr>
			{/foreach}
	</tbody>
{/foreach}	

</table>

<div class="pageoptions">
	<p class="pageoptions">{$addlink}</p>
</div>


