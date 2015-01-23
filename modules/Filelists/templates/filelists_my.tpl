{if $count_filelists > 0}
	<div class="row narrow simple_blocks">
		{foreach from=$filelists item="filelist"}
			<div class="col-xs-12 year_{$date[0]} month_{$date[1]}">
				<div class="f_item">
					<a href="{$filelist.link}" class="photo">
						{if $filelist.file != ''}
							{CGSmartImage src=$filelist.file_full filter_croptofit='88,88,c' noautoscale='false'}
						{/if}
					</a>
					<div class="cont">
						<a href="{$filelist.link}">{eval var=$filelist.filename|substr_f:100}</a>
						<span class="date">{$filelist.date|date_format:'%Y-%m-%d'}</span>
						<div>
							{eval var=$filelist.short_desc|substr_f:100:1}
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
				
				
			{*	
				
				<div class="filelist_title">{$filelist.filename}</div>
				<div class="filelist_author">{#author#} {$filelist.user_name} {$filelist.user_surename}</div>
				<div class="filelist_date">{#ikelta#} {$filelist.date}</div>
				<div class="filelist_short_desc">{$filelist.detail}</div>
				<div class="filelist_download">
					{if $filelist.active != 1}
						{assign var="e_status" value="error_status_`$filelist.active`"}
						<div class="button s2 ext_button ext_submit_button_red fr" style="margin-left:10px;">
							<span>{$smarty.config.$e_status}</span>
							<span></span>
						</div>
						&nbsp;
					{/if}
					{if $filelist.link != ''}
						<div class="button s2 ext_button ext_submit_button fr" style="margin-left:10px;">
							<a href="{$filelist.link}" target="_blank">
								<span>{#placiau#}</span>
								<span></span>
							</a>
						</div>
					{/if}
					{if $filelist.url != ''}
						<div class="button s2 ext_button ext_submit_button fr" style="margin-left:10px;">
							<a href="{$filelist.url}">
								<span>{#redaguoti#}</span>
								<span></span>
							</a>
						</div>
					{/if}
					{if $filelist.file != ''}
						<div class="button s2 ext_button ext_submit_button fr" style="margin-left:10px;">
							<a href="{root_url}/download.php?action=FilelistGetFile&id={$filelist.id}" target="_blank">
								<span>{#atsisiusti#}</span>
								<span></span>
							</a>
						</div>
					{/if}
				</div>
			</div>*}
		{/foreach}
	</div>
{else}
	<div class="filelist_list2">
		{#no_filelists#}
	</div>
{/if}
<br/>
{if $add_edit}
	<div class="add_filelist_block">
		<a href="{$add_edit}">{#add_filelist#}</a>
	</div>
{/if}