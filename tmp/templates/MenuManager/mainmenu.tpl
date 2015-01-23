<ul class="main_menu">
	{foreach from=$nodelist item=node name=pagr key=key}
		{if $node->depth==2}
			<li class="{if ($node->current == true) || ($node->parent) }selected{/if}">
				<a href="{$node->alias}.html"><span>{$node->menutext}</span></a>
				{capture assign="parent_alias"}{$node->alias}.html{/capture}
				{menu childrenof=$node->id template="mainmenu2" number_of_levels="1"}
			</li>
		{/if}
	{/foreach}
</ul>