{capture assign="clients"}[{foreach from=$irasai item=ii name="blokai" key=key}{if $key != '0'},{/if}{literal}{{/literal}latLng: [{$ii.pavadinimas2}], name: '{$ii.pavadinimas}'{literal}}{/literal}{/foreach}]{/capture}

{capture assign="clients_descriptions"}
    <ul class="map_pathners_descriptions" style="display:none">
        {foreach from=$irasai item=ii}				
               <li data-coords="{$ii.pavadinimas2}" data-href="{$ii.nuoroda}">{$ii.tekstas}</li>
        {/foreach}	
    </ul>
{/capture}

{capture assign="client_table"}
	<br/>
	<table class="client_table" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th>{#pavadinimas#}</th>
				<th>{#tekstas#}</th>
				<th>{#nuororeda#}</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$irasai item=xx}	
				<tr class="miestas miestas-49" style="display: table-row;">
					<td>{$xx.pavadinimas}</td>
					<td>{$xx.tekstas}</td>
					<td><a href="{$xx.nuoroda}">{#nuororeda#}</a></td>
				</tr>
			{/foreach}	
		</tbody>
	</table>
{/capture}