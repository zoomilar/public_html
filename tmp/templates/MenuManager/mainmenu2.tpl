	<div class="submenu_container">
		<div class="container section">
			<ul>
		{foreach from=$nodelist item=node2 name=pagr}
			<li class="{if ($node2->current == true) || ($node2->parent) }selected{/if}">
				<a href="{$node2->alias}.html">{$node2->menutext}</a>
				{*menu childrenof=$node2->id template="mainmenu3" number_of_levels="1"*}
			</li>
		{/foreach}
			</ul>
			<div class="submenu_custom_contenbt">
				{MeniuAdd alias=$parent_alias}
			</div>			
		</div>
</div>