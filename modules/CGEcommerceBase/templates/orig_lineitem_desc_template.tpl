{* product summary template *}
{* used for summarizing products in view cart form page *}
{strip}
{if isset($product_obj)}
{$product_obj->get_name()}&nbsp;
{foreach from=$meta->attributes item='attrib'}
  {$attrib->name}&nbsp;{if $attrib->adjustment != 0}{$currencysymbol}({$attrib->adjustment|number_format:2}){/if}&nbsp;
{/foreach}
{/if}
{/strip}