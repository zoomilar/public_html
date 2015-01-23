<nav class="flt-right">
  {foreach from=$nodelist item=node name=pagr}
		{if $node->depth==2}            
			{if ($node->current == true) || ($node->parent) }{assign var="active_level" value=6}{/if}
            	<a href="{$node->alias}.html">{$node->menutext}</a>  
    	{/if}
	{/foreach}
</nav>