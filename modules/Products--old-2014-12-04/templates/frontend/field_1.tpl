{if $field|is_array && $field|@count > 0}
	<ul class="labels2">
		{foreach from=$field item="iso"}
			<li>
				<a href="#" title="{$iso.$kalba}" data-filter=".{$iso.$kalba|replace:' ':''}">
					{if $iso.file}
						<img src="{$file_location}/{$iso.file}" alt="">
					{else}
						<img src="{root_url}/images/icons/ico_checkbox.png" class="sort_main" alt="">
						<img src="{root_url}/images/icons/ico_checkbox_s.png" class="sort_select" alt="">
						{$iso.$kalba}
					{/if}
				</a>
			</li>
		{/foreach}
	</ul>
{/if}