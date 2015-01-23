{*
#CMS - CMS Made Simple
#(c)2004-6 by Ted Kulp (ted@cmsmadesimple.org)
#This project's homepage is: http://cmsmadesimple.org
#
#This program is free software; you can redistribute it and/or modify
#it under the terms of the GNU General Public License as published by
#the Free Software Foundation; either version 2 of the License, or
#(at your option) any later version.
#
#This program is distributed in the hope that it will be useful,
#but WITHOUT ANY WARRANTY; without even the implied warranty of
#MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#GNU General Public License for more details.
#You should have received a copy of the GNU General Public License
#along with this program; if not, write to the Free Software
#Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#
#$Id$	
*}

<div id="filterform">
{$formstart}
<fieldset style="width: 49%; float: left;">
  <legend>{$mod->Lang('filters')}:&nbsp;</legend>
  <div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('hierarchy')}:</p>
    <p class="pageinput">{$input_hierarchy}&nbsp;{$mod->Lang('include_children')} {$input_children}</p>
  </div>
  {if isset($category_list)}
  <div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('category')}:</p>
    <p class="pageinput">
      <select name="{$actionid}categories[]" multiple="multiple" size="5">
        {html_options options=$category_list selected=$categories}
      </select>
    </p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('exclude_categories')}:</p>
    <p class="pageinput">{$input_excludecats}</p>
  </div>
  {/if}
  <div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('sort_by')}:</p>
    <p class="pageinput">{$input_sortby}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('sort_order')}:</p>
    <p class="pageinput">{$input_sortorder}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('page_limit')}:</p>
    <p class="pageinput">{$input_pagelimit}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">&nbsp;</p>
    <p class="pageinput">
      <input type="submit" name="{$mod->GetActionId()}submit" value="{$mod->Lang('submit')}">
      <input type="submit" name="{$mod->GetActionId()}reset" value="{$mod->Lang('reset')}">
    </p>
  </div>
</fieldset>
<fieldset style="width: 47%; float: right;">
  <legend>{$mod->Lang('view')}</legend>
  {if isset($fields_viewable)}
  <div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('viewable_fields')}:</p>
    <p class="pageinput">
      <select name="{$actionid}custom_fields[]" size="3" multiple="multiple">
      {html_options options=$fields_viewable selected=$custom_fields}
      </select>
    </p>
  </div>
  <div class="pageoverflow">
	<p class="pagetext">{$mod->Lang('ieskoti_pagal')}:</p>
    <p class="pageinput"><input type="text" name="{$mod->GetActionId()}search_box" value="{$search_box}"></p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">&nbsp;</p>
    <p class="pageinput"><input type="submit" name="{$mod->GetActionId()}submit" value="{$mod->Lang('submit')}"></p>
  </div>
  {/if}
</fieldset>
<div style="clear: both;"></div>
{$formend}
</div><!-- filterform -->


<div id="productlist">
<script type="text/javascript">{literal}
$(document).ready(function(){
  $('#filterform').hide();
  $('#filterbox').click(function(){
    $('#filterform').toggle();
  });
  $('#select_all_products').click(function(){
    var checked = $(this).attr('checked');
    $('.multiselect').attr('checked',checked); 
  });
  $('#bulkaction_submit').click(function(){
    var len = $('#productlist tbody input:checkbox:checked').length;
    if( len == 0 )
    {
      alert('{/literal}{$mod->Lang('nothing_selected')}{literal}');
      return false;
    }
    return true;
  });
});
{/literal}</script>

<div class="pageoptions">
 <input type="checkbox" id="filterbox" value="1"/><label for="filterbox">{$mod->Lang('filter')}{if $filterinuse}&nbsp;<em>({$mod->Lang('filterinuse')})</em>{/if}&nbsp;</label>
 {$addlink}&nbsp;{*$importlink*}
</div>
{if $itemcount gt 0}
  {$formstart2}
  {if isset($firstpage_url)}
    <a href="{$firstpage_url}" title="{$mod->Lang('firstpage')}">{$mod->Lang('firstpage')}</a>
    <a href="{$prevpage_url}" title="{$mod->Lang('prevpage')}">{$mod->Lang('prevpage')}</a>
  {/if}
  {if isset($firstpage_url) || isset($lastpage_url)}
    {$mod->Lang('page_of',$pagenumber,$pagecount)}
  {/if}
  {if isset($lastpage_url)}
    <a href="{$nextpage_url}" title="{$mod->Lang('nextpage')}">{$mod->Lang('nextpage')}</a>
    <a href="{$lastpage_url}" title="{$mod->Lang('lastpage')}">{$mod->Lang('lastpage')}</a>
  {/if}
  <table cellspacing="0" class="pagetable cms_sortable tablesorter">
    <thead>
      <tr>
	<th>{$idtext}</th>
	<th>{$producttext}</th>
	<th>{$mod->Lang('status')}</th>
	<th>{$mod->Lang('last_modified')}</th>
        {if isset($custom_fields)}
          {foreach from=$custom_fields item='fid'}
            <th>{$fields_viewable.$fid}</th>
          {/foreach}
        {/if}
	<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
	<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
	<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
	<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
        <th class="pageicon {literal}{sorter: false}{/literal}"><input type="checkbox" title="{$mod->Lang('select_all')}" value="1" name="select_all" id="select_all_products"></th>
      </tr>
    </thead>
    <tbody>
      {foreach from=$items item=entry}
	{cycle values="row1,row2" assign='rowclass'}
	<tr>
	<td>{$entry.id}</td>
	<td><a href="{$entry.edit_url}" title="{$mod->Lang('edit')}">{$entry.product_name}</a>
	
	</td>
	<td>{$mod->Lang($entry.status)}</td>
	<td>{$entry.modified_date|cms_date_format}</td>
        {if isset($custom_fields) && count($custom_fields)}
          {foreach from=$custom_fields item='fid'}
            <td>{capture assign='tmp'}{$field_names.$fid}{/capture}
              {$entry.$tmp}</td>
          {/foreach}
        {/if}
	<td>{$entry.attribslink}</td>
	<td>{$entry.editlink}</td>
	<td>{$entry.copylink}</td>
	<td>{$entry.deletelink}</td> 
        <td><input type="checkbox" class="multiselect" name="{$actionid}multiselect[]" value="{$entry.id}"></td>
        </tr>
      {/foreach}
    </tbody>
  </table>

  <div class="pageoptions" style="height: 2em;">
    <div style="width: 40%; float: left; margin-top: 0.5em;">
      {$addlink}&nbsp;{*$importlink*}{if $itemcount gt 0}&nbsp;{*$exportlink*}{/if}
    </div>
    {if $itemcount gt 0}
      <div style="text-align: right; width: 40%; float: right; margin-top: 0.5em; margin-bottom: 0.5em;">
        {$mod->Lang('with_selected')}:
        <select name="{$actionid}bulkaction">{html_options options=$bulkactions}</select>
        <input type="submit" id="bulkaction_submit" name="{$actionid}submit" value="{$mod->Lang('go')}"/>
      </div>
    {/if}
  </div>
{$formend2}
{/if}
</div><!-- productlist -->
