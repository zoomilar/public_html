{if $show_filelists}
	
	{*if $add_edit}
		<a href="{$add_edit}" class="ext_button red f_22 fr">
			<span>{#add_filelist#}</span>
		</a>
	{/if*}
	{if $file_groups}
		<ul class="labels3">

			{foreach from=$file_groups item="file_g"}
				{if $file_g != ''}
					<li>
						<a href="#" class="is_filter_all" title="" data-filter=".{$file_g|md5}">
							<img src="{root_url}/{$file_g}" alt=""/>
						</a>
					</li>
				{/if}
			{/foreach}
		</ul>
	{/if}
	
	{if $count_filelists > 0}
		<div class="recepies_list isotope2">
			{foreach from=$filelists item="filelist"}
				<div class="is_item {$filelist.file2|md5}">
					<h2>
						{$filelist.filename}
					</h2>
					<div class="recepies_list_image">
						{if $filelist.files|@count > 0}
							{CGSmartImage src=$filelist.files[0].full filter_croptofit='200,150,c' noautoscale='false'}
						{/if}
					</div>
					{if $filelist.file_size || $filelist.location}
						<div class="cont1">
							{if $filelist.file_size}
								<div class="cont1_size">
									{#filelist_size#}: {$filelist.file_size}
								</div>
							{/if}
							{if $filelist.location}
								<div class="cont1_page_count">
									{#filelist_count#}: {$filelist.location}
								</div>
							{/if}
						</div>
					{/if}
					<div class="cont2">
						<div class="cont2_date">
							{$filelist.date|date_format:'%Y. %m. %d.'}
						</div>
						{if $filelist.is_download}
							<div class="cont2_download">
								<a href="#file_list{$filelist.id}" class="fancy_download">{#filelist_download#}</a>
								{*<a href="{root_url}/download.php?action=FilelistGetFile&id={$filelist.id}" target="_blank">{#filelist_download#}</a>*}
							</div>
							<div id="file_list{$filelist.id}" style="display:none;">
								{foreach from=$filelist.files2 item="itm"}
									<div> <a href="{root_url}/download.php?action=FilelistGetFile&id={$filelist.id}&file={$itm.name}" target="_blank">{$itm.name}</a></div>
								{/foreach}
								
							</div>
						{/if}
					</div>
				</div>
			{/foreach}
		</div>
		
			{*foreach from=$filelists item="filelist"}
				{assign var="date" value='-'|explode:$filelist.date}
				<div class="col-xs-6 iso_item year_{$date[0]} month_{$date[1]}">
					<div class="f_item">
						<a href="{$filelist.link}" class="photo">
							{if $filelist.file != ''}
								{CGSmartImage src=$filelist.file_full filter_croptofit='88,88,c' noautoscale='false'}
							{/if}
						</a>
						<div class="cont">
							<a href="{$filelist.link}">{eval var=$filelist.filename}</a>
							<span class="date">{$filelist.date|date_format:'%Y-%m-%d'}</span>
							<div>
								{eval var=$filelist.short_desc}
							</div>
						</div>
						{if $filelist.active != 1 || $filelist.url != ''}
							<div class="filelist_admin">
								{if $filelist.active != 1}
									{assign var="e_status" value="error_status_`$filelist.active`"}
									<div class="button s2 ext_button ext_submit_button_red fr" style="margin-left:10px;">
										<span>{$smarty.config.$e_status}</span>
										<span></span>
									</div>
									&nbsp;
								{/if}
								{if $filelist.url != ''}
									<div class="button s2 ext_button ext_submit_button fr" style="margin-left:10px;">
										<a href="{$filelist.url}">
											<span>{#redaguoti#}</span>
											<span></span>
										</a>
									</div>
								{/if}
							</div>
						{/if}
					</div>
				</div>
			{/foreach*}
		
	{else}
		<div class="filelist_list2">
			{#no_filelists#}
		</div>
	{/if}
	
	
{else}
	{*menu childrenof=$content_obj->mId template="filelists" number_of_levels="1"*}
{/if}