<h3>{#produco_parametrai#}</h3>
{*$formstart*}
<form action="{$url_path}" method="get">
	<div class="products_filter_selects">
		{if $filters|is_array && $filters|@count > 0}
			{foreach from=$filters item="filt"}
				{if $filt.type == 'dropdown'}
					<div class="styled_select_place">
						{$filt.input}
					</div>
				{elseif $filt.type == 'checkboxgroup'}
					{*<pre>
					{$filt.input|@print_r}
					</pre>*}
					
					<dl class="dropdown_filt_checkbox"> 
  
						<dt>
							<a href="#">
								{if $filt.selected_names|@count > 0}
									<span class="hida" {*style="display:none;"*}>{$filt.prompt}: </span>    
									<p class="multiSel">
										{foreach from=$filt.selected_names item="ck_name"}
											<span title="{$ck_name},">{$ck_name},</span>
										{/foreach}
									</p>  
								{else}
									<span class="hida">{$filt.prompts.$kalba}: </span>    
									<p class="multiSel"></p>  
								{/if}
							</a>
						</dt>
					  
						<dd>
							<div class="mutliSelect">
								<ul>
									{foreach from=$filt.input item="inp"}
										<li>
											{$inp.input} {$inp.title}
										</li>
									{/foreach}
								</ul>
							</div>
						</dd>
					</dl>
				{/if}
			{/foreach}
		{/if}
	</div>
	<br/>
	<div class="full_width" align="right">
		<a class="ext_button yellow f_13 reser_filter" href="#">
			<span>{#reset#}</span>
		</a>
		<a class="ext_button yellow f_13 click_submit_form" href="#">
			<span>{#filtruoti#}</span>
		</a>
	</div>
</form>
{*$formend*}
<br/>