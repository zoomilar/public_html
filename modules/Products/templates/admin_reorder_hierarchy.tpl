{if $depth_ro == 0}
<script type="text/javascript">
{literal}
function parseTree(ul){
	var tags = [];
	ul.children("li").each(function(){
		var subtree =	$(this).children("ul");
		if(subtree.size() > 0)
			tags.push([$(this).attr("id"), parseTree(subtree)]);
		else
			tags.push($(this).attr("id"));
	});
	return tags;
}

$(document).ready(function(){
  $('ul.sortable').nestedSortable({
     disableNesting: 'no-nest',
     forcePlaceholderSize: true,
     handle: 'div',
     items: 'li',
     opacity: 6,
     placeholder: 'placeholder',
     tabSize: 35,
     tolerance: 'pointer',
     listType: 'ul',
     toleranceElement: '> div'
  });

  $('html').delegate('#submit_btn', 'click', function(e){
	//e.preventDefault();
     var tree = $.toJSON(parseTree($('ul.sortable')));
     $('#orderdata').val(tree);
  });

});
{/literal}
</script>

<h3>{$mod->Lang('reorder_hierarchy')}</h3>
<div class="pagetext">{$mod->Lang('info_reorder_content')}</div>
{$formstart}
<input type="hidden" name="{$actionid}orderdata" value="" id="orderdata"/>

<div class="pageoverflow">
  <div class="reorder-pages pageinput">
{/if}
    <ul class="sortableList {if $depth_ro==0}sortable{/if}">
    {foreach from=$tree item='item'}
      <li id="hier_{$item.id}"><div class="label"><span>&nbsp;</span>{$item.name.lt}</div>
        {if isset($item.children)}
          {include file=$smarty.template depth_ro=$depth_ro+1 tree=$item.children}
		  {assign var="depth_ro" value=$depth_ro-1}
        {/if}
      </li>
    {/foreach}
    </ul>
{if $depth_ro == 0}
  </div>
</div>

<div class="pageoverflow">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input id="submit_btn" type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
    <input type="submit" name="{$actionid}cancel" value="{$mod->Lang('cancel')}"/>
  </p>
</div>
{$formend}
{/if}