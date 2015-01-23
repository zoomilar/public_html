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
<script src="{root_url}/modules/Products/products.js" type="text/javascript"></script>
{$startform}
<div class="pageoverflow">
  <p class="pagetext">*{$mod->Lang('name')}:</p>
  <p class="pageinput">{$inputname}&nbsp;{$mod->Lang('info_alnumonly')}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">*{$mod->Lang('prompt')}:</p>
  <div class="pageinput">
	<table>
	 <tr>
	  {foreach from=$kalbos item=kalba}
		<td>{$mod->Lang($kalba)}<br/>{$inputprompt.$kalba}</td>
	  {/foreach}
	 </tr>
	</table>
  </div>
</div>


{*<div class="pageoverflow">
  <p class="pagetext">*{$mod->Lang('prompt')}:</p>
  <p class="pageinput">{$inputprompt}</p>
</div>*}

{if $showinputtype eq true}
<div class="pageoverflow">
  <p class="pagetext">*{$mod->Lang('type')}:</p>
  <p class="pageinput">{$inputtype}</p>
</div>
{else}
  {$inputtype}
{/if}


{if $type == 'dropdown' || $type == 'checkboxgroup'}

<div class="pageoverflow">
  <p class="pagetext">*{if $type=='checkboxgroup'}{$mod->Lang('checkbox_options')}{else}{$mod->Lang('dropdown_options')}{/if}:</p>
		<div style="display:none" id="optiondef">
		  <div class="optrow">			
			
				<table>
				 <tr>
				  {foreach from=$kalbos item=kalba}
					<td>{$mod->Lang($kalba)}<br/>
						<input type="text" name="{$actionid}options[]" value="" />
					</td>
				  {/foreach}
					<td>
						<input type="text" name="{$actionid}opt_link[]" value=""/>
					</td>
					<td>{$mod->Lang('failas')}<br/>
						<input type="file" name="opt_file[]" />
						<input type="hidden" name="{$actionid}opt_file_old[]" value="" />
					</td>
					<td valign="bottom" style="padding-bottom: 7px">
						<input type="checkbox" class="deletethis"  name="{$actionid}optionsdelete[]" value="1" /> {$mod->Lang('delete')}?
					</td>
				 </tr>
				</table>
				
		  </div>	
		</div>  
  <div class="pageinput">

	<div id="optionlist">
	
	{foreach from=$options item=entry}
	  <div class="optrow">
	  
				<table>
				 <tr>
				  {foreach from=$kalbos item=kalba}	  
					<td>{$mod->Lang($kalba)}<br/>
						<input type="text" name="{$actionid}options[]" value="{$entry.$kalba}" />
					</td>	  
				  {/foreach}
					<td>{$mod->Lang('link')}<br/>
						<input type="text" name="{$actionid}opt_link[]" value="{$entry.link}"/>
					</td>
					<td nowrap="nowrap">{$mod->Lang('failas')}<br/>
						<input type="file" name="opt_file[]" />
						<input type="hidden" name="{$actionid}opt_file_old[]" value="{$entry.file}" />
						{if $entry.file}
							<a href="{root_url}/uploads/Products/fielddef/{$entry.file}" target="_blank">{$entry.file}</a>
						{/if}
					</td>
					<td valign="bottom" style="padding-bottom: 7px">
						<input type="checkbox" class="deletethis"  name="{$actionid}optionsdelete[]" value="1" /> {$mod->Lang('delete')}?
					</td>
				 </tr>
				</table>
	  </div>
	{/foreach}
	</div>
	
	<input class="cms_submit" name="m1_submit" id="addmore" value="{$mod->Lang('addmore')}" type="button" /> 
	<input class="cms_submit" name="m1_cancel" id="deleteselected" value="{$mod->Lang('deleteselected')}" type="button" /> 	
	

  
  {*<textarea name="{$actionid}options">{$options}</textarea>*}
  
  </div>
</div>
{/if}




{if $type == 'textbox'}
<div class="pageoverflow">
  <p class="pagetext">*{$mod->Lang('maxlength')}:</p>
  <p class="pageinput">{$inputmaxlength}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">*{$mod->Lang('requ_lang')}:</p>
  <p class="pageinput">{$requ_lang}</p>
</div>
{/if}

{if $input_laukeliu_grupes}
<div>
	<p class="pagetext">{$mod->Lang('prisk_grup')}:</p>
	<p class="pageinput">{$input_laukeliu_grupes}</p>
</div>
{/if}

{*
{if $type == 'dropdown'}
<div class="pageoverflow">
  <p class="pagetext">*{$mod->Lang('dropdown_options')}:</p>
  <p class="pageinput"><textarea name="{$actionid}options">{$options}</textarea></p>
</div>
{/if}
*}

<div class="pageoverflow">
  <p class="pagetext">*{$userviewtext}:</p>
  <p class="pageinput">{$input_userview}<br/>{$mod->Lang('info_publicfield')}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$hidden}{$submit}{$cancel}</p>
</div>
{$endform}
