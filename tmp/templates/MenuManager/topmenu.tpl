<ul class="main_menu">
    {foreach from=$nodelist item=node name=topm}
		{if $node->depth==2}
            <li class="{if ($node->current == true) || ($node->parent) }selected{/if}">
            	<a href="{$node->alias}.html">
					{$node->menutext}
				</a>  
				{*menu childrenof=$node->id template="mainmenu2" number_of_levels="1"*}			
            </li>
			
    	{/if}
	{/foreach}
</ul>