{if isset($catformstart)}
{$catformstart}
{$catdropdown}{$catbutton}
{$catformend}
{/if}

{if isset($pagecount) && $pagecount gt 1}
{$firstlink}&nbsp;{$prevlink}&nbsp;&nbsp;{$pagetext} {$curpage} {$oftext} {$pagecount}&nbsp;&nbsp;{$nextlink}&nbsp;{$lastlink}
{/if}

{foreach from=$items item=entry}
   {* 
     the summary template has access to custom fields via the $entry->fields hash
     and to categories via the $entry->categories array of objects.  Also
     attribute information is available via $entry->attributes.
     you should use the get_template_vars and the print_r modifier to see
     what is available
    *}
  <div class="ProductDirectoryItem">
     <a href="{$entry->detail_url}">{$entry->product_name}</a>&nbsp;({$entry->weight}{$weight_units})&nbsp;&nbsp;{$currency_symbol}{$entry->price}
     {if isset($entry->categories)}
       Categories:&nbsp;
       {foreach from=$entry->categories item='category'}
         {$category->name},&nbsp;
       {/foreach}
       <br/>
     {/if}     
  </div>

  {* include the cart 
  {cge_have_module m='CGEcommerceBase' assign='tmp'}
  {if $tmp}
  <div>
  {cgecomm_form_addtocart product=$entry->id} 
  </div>
  {/if}
  *}

{/foreach}
