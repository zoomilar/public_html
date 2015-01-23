{if $nodelist|@count}
<div id="sidebar">
    <ul class="side_menu">
        {foreach from=$nodelist item=node name=sida}
            {if $node->depth==1}
                <li class="{if ($node->current == true) || ($node->parent)}selected{/if}">
                    <a href="{$node->alias}.html">{$node->menutext}</a>
                    {*menu childrenof=$node->id template="side_meniu2" number_of_levels="1"*}
                </li>						
            {/if}
        {/foreach}
	</ul>
</div>
{/if}
