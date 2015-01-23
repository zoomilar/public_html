{if !$incl} 
 <script src="/modules/Titulinis/scripts.js" type="text/javascript"></script>
 <input type="hidden" name="six" value="{$smarty.get._sx_}">
 {assign var="incl" value=1}
{/if}

	
<div class="pageoptions">
	<p class="pageoptions">{$addlink}</p>
</div>

<table cellspacing="0" class="pagetable">
	<thead>
		<tr>
        	{foreach from=$titulinio_tabai item=tabas}
            	{if $tabas.title == $kateg}
                	{foreach from=$tabas.allowed_inputs item=alowed_input}
					 {if $alowed_input != "kalba"}
                		 <th><div>{$Titulinis->Lang($alowed_input)}</div></th>
					 {/if}	  
                    {/foreach}
                {/if}
            {/foreach}
            <th>&nbsp;</th>
		</tr>
	</thead>
{foreach from=$kalbos item=kalba key=kl}
	<tbody id='{$kalba}'>
			<tr>
            	<td colspan='15' style="background-color: #e5e5e5"><b>{*$kalba|upper*}</b></td>
            </tr>
			{assign var='nmb' value='0'}
			{foreach from=$prop_array.$kl item=entry}
				{assign var='nmb' value=$nmb+1}
				<tr class="row1" onmouseover="this.className='row1hover';" onmouseout="this.className='row1';" id='lt-{$nmb}'>
                    {foreach from=$titulinio_tabai item=tabas}
            			{if $tabas.title == $kateg}
                			{foreach from=$tabas.allowed_inputs item=alowed_input}
							  {if $alowed_input != "kalba"}
								<td style="text-align:left">
                                <div>
                                	{if $alowed_input == "paveiksliukas"}
                                        {if $allow_more || ($cuser == $entry->userid)}
                                            <a style="display:block; padding:15px 0" href="moduleinterface.php?_sx_={$smarty.get._sx_}&mact={$mod_w},m1_,editprop,0&prop_id={$entry->id}&m1_kat={$kateg}" class="roo" id="r-{$entry->kategorija}-{$nmb}">
                                                {assign var="image_url" value="`$root_url`/uploads/images/titulinis/`$entry->$alowed_input`"}
							
												{CGSmartImage src=$image_url filter_resize='w,150' max_height='80' noautoscale='false'}
                                            </a>
                                        {else}
                                            {$entry->$alowed_input}
                                        {/if}
                                    {else}
										{if $approve_style.$alowed_input}
										{*assign var="tr" value="true"}
										{assign var="fl" value="false"*}
										{*if $alowed_input == "nerodyti" || $alowed_input == "bilietunera"*}
											{assign var="tr" value="false-x"}
											{assign var="fl" value="false"}
										{*/if*}
										
										 <div style="padding-left: 10px"> 
											{if ($entry->$alowed_input == 1)}
												<a href="javascript:void(0)"><img src="themes/OneEleven/images/icons/system/{$tr}.gif" class="systemicon changestatus" ico-t="{$tr}" ico-inv="{$fl}" state="true" fid="{$entry->id}" fname="{$alowed_input}"></a>
											{else}
												<a href="javascript:void(0)"><img src="themes/OneEleven/images/icons/system/{$fl}.gif" class="systemicon changestatus" ico-t="{$tr}" ico-inv="{$fl}" state="false" fid="{$entry->id}" fname="{$alowed_input}"></a>
											{/if}	
										 </div>	
										 {else}
										 {if $allow_edit || ($cuser == $entry->userid)}
											<a href="moduleinterface.php?_sx_={$smarty.get._sx_}&mact={$mod_w},m1_,editprop,0&prop_id={$entry->id}&m1_kat={$kateg}">{$entry->$alowed_input|truncate:30}</a>
										 {else}									
											{$entry->$alowed_input|truncate:30}
										 {/if}
										 {/if}
                                    {/if}
                                </div>
                                </td>
							 {/if}	
                            {/foreach}
                		{/if}
            		{/foreach}
                    <td style="width:100px"><div>{if $allow_edit || ($cuser == $entry->userid)}<a href="moduleinterface.php?_sx_={$smarty.get._sx_}&mact={$mod_w},m1_,editprop,0&prop_id={$entry->id}&m1_kat={$kateg}">edit</a>{/if}&nbsp;{if $allow_del == "yes" || ($cuser == $entry->userid)}|&nbsp;<a onclick="if(!confirm('ar tikrai?')) return false;" href="moduleinterface.php?_sx_={$smarty.get._sx_}&mact={$mod_w},m1_,deleteprop,0&prop_id={$entry->id}">delete</a>{/if}</div></td>
				</tr>
			{/foreach}
	</tbody>
{/foreach}	

</table>

<div class="pageoptions">
	<p class="pageoptions">{$addlink}</p>
</div>


