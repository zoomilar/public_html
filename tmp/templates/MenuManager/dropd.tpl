<div class="main_menu_second_level">
    {foreach from=$nodelist item=node name=langu}
        {if $node->depth==1}
            <div class="{if ($node->current == true) || ($node->parent) }selected {/if}{if $node->children_exist}has_submenu{/if}">
                <a href="{$node->url}">
                    <span>{$node->menutext}</span>
                </a>
                {menu childrenof=$node->id template="dropd2" number_of_levels="1"}
            </div>
        {/if}
    {/foreach}
</div>