<div id="map"></div>
{capture assign="contries"}{foreach from=$irasai item=ii name="blokai" key=key}{if $key != '0'},{/if}'{$ii.pavadinimas2}':[{$key}]{/foreach}{/capture}
<ul class="map_descriptions" style="display:none">
	{foreach from=$irasai item=ii name="blokai"}
    	<li data-code="{$ii.pavadinimas2}" data-href="{$ii.nuoroda}">{$ii.tekstas}</li>
    {/foreach}	
</ul>

{Titulinis kategorija="klientai" kalba=$kalba}

{literal}
<script>
    $(document).ready(function() { 
        var contries = {{/literal}{$contries}{literal}};
        cities = {/literal}{$clients}{literal}
        world_vector_map_init(contries, cities);
    })
    
</script>
{/literal}

{$clients_descriptions}

{if $vidinis == 1}
	{$client_table}
{/if}

