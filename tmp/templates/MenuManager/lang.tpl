<div class="langs_drop">
    <ul class="drop">
        {assign var=kiekkalbu value=$nodelist|@count}
        {foreach from=$nodelist item=node name=langu}
            {if $node->depth==1}
                <li class="{if ($node->current == true) || ($node->parent) } selected{assign var=kalba value=$node->alias}{assign var=kalba2 value=$node->menutext}{/if}"><a href="/{$node->alias}/">{$node->menutext}</a></li>
            {/if}
        {/foreach}
    </ul>
    <a href="#">{$kalba2}</a>
</div>
