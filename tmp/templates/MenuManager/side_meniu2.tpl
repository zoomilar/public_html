{if $nodelist|@count}
							<ul class="side_menu">
							{foreach from=$nodelist item=node name=sida}
						{if $node->depth==1}
							<li class="{if ($node->current == true) || ($node->parent)}selected{/if}">
								<a  href="{$node->alias}.html">{$node->menutext}</a>
							</li>						
						{/if}
					{/foreach}
							</ul>
{/if}
                