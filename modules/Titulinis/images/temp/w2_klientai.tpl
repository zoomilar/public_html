	{foreach from=$irasai item=ii}	
	 <div class="client_logo">
		<a href="{if $ii.nuoroda}{$ii.nuoroda}{else}javascript:void(0);{/if}"{if $ii.nuoroda} target="_blank"{else} style="cursor: default"{/if}><img src="{root_url}/uploads/images/titulinis/thumb2_{$ii.paveiksliukas}" width="107" height="35" alt=""/></a>
	 </div>	
	{/foreach}
