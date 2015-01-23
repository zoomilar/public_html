<div class="level-2 footer">
        <ul class="content">
			{*}<li class="category"><span class="title"><span>Leggeri (3,3 - 7,0 t)</span></span><ul>{*}
		{foreach from=$nodelist item=node3 name=pagr}
			<li class="item {if ($node3->current == true) || ($node3->parent) }selected{/if}">
			{menu childrenof=$node3->id template="mainmenu3_sublink" number_of_levels="1" assign="sublink"}
				<a href="{if $sublink}{$sublink}{else}{$node3->alias}.html{/if}">
				{if $node3->img}
				<img src="{CGSmartImage src=$node3->img filter_croptofit='105,80,c,1' noautoscale='false' notag=1}">
				{else}
				<img src="{CGSmartImage src="/common/publishingimages/blank.jpg" filter_croptofit='105,80,c,1' noautoscale='false' notag=1}">
				{/if}
				<span>{$node3->menutext}</span></a>
				{*menu childrenof=$node->id template="mainmenu3" number_of_levels="1"*}
			</li>
		{/foreach}
		 {*}</ul>{*}
		</ul>
</div>