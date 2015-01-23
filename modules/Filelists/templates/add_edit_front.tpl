<script src="{root_url}/modules/Filelists/lib/uploader/plupload.full.min.js" type="text/javascript"></script>
<script src="{root_url}/modules/Filelists/filelists.js" type="text/javascript"></script>
<script type="text/javascript" src="{root_url}/js/jquery-ui.min.js"></script>
<script src="{root_url}/js/tx.preloader.js" type="text/javascript"></script>
{literal}
<script>
//var delete_filelist = '{/literal}{#delete_filelist#}{literal}';

var delete_image = '{/literal}{$mod->lang("delete_image")}{literal}';
var root_url = '{/literal}{root_url}{literal}';
var filelist_id = '{/literal}{if isset($filelist_id)}{$filelist_id}{else}{$filelist_id_tmp}{/if}{literal}';

$(document).ready(function () {
	/*$('[data-input="date"]').datepicker({ 
		dateFormat: "yy-mm-dd",
		firstDay: 1
	});
	
	$('[data-input="time"]').datetimepicker({
		datepicker:false,
		format:'H:i'
	});
	
	$('[data-input="time"]').addClass('has_timepicker');*/
	
	$('.save_edit_filelist').click(function(e) {
		e.preventDefault();
		
		$(this).parents('form:first').submit();
	});
	
	/*$('.delete_filelist').click(function(e) {
		if (!confirm(delete_filelist)) {
			e.preventDefault();
		}
	});*/
	
	
	get_current_files(filelist_id);
	init_the_uploader(filelist_id);
	
	$('div.filelist_edit input[type="text"], div.filelist_edit textarea').change(function(){
		$(this).parent('*').removeClass('in_error')
	})
	
});
</script>
{/literal}
<h1 class="f_36 font_sacramento-regular-webfont nouppercase custom_title">{title}</h1>
<div class="filelist_edit">
{if is_array($errors) && $errors|@count > 0}
	<ul class="errors_list_2">
	{foreach from=$errors item="error"}
		<li class="error">{$smarty.config.$error}</li>
	{/foreach}
	</ul>
    <br />
{/if}
{*$start_form*}
	<h2>{#new_filelist#}</h2>
    <br />
	<form action="{$form_action}" method="post" class="cms_form" enctype="multipart/form-data">
		<dl class="form_loop">
			<dt>
				{#title_filelist#}
			</dt>
			<dd{if "no_file"|in_array:$errors} class="in_error"{/if}>
				{$input_filename}
			</dd>
			
			{*<dt>
				{#title_date#}
			</dt>
			<dt>
				{$input_date} {$input_time_start}
			</dt>
			
			<dt>
				{#input_date_end#}
			</dt>
			<dt>
				{$input_date_end} {$input_time_end}
			</dt>
			*}
			<dt>
				{#title_location#}
			</dt>
			<dd class="full_width">
				{$input_location}
			</dd>
			
			<dt>
				{#title_short_desc2#}
			</dt>
			<dd class="full_width">
				{$input_short_desc}
			</dd>
			
			
			<dt>
				{#title_detail#}
			</dt>
			<dd class="full_width">
				{$input_detail}
			</dd>
			
			<dt>
				{#title_cooking_course#}
			</dt>
			<dd class="full_width">
				{$input_cooking_course}
			</dd>
			
			{*
			<dt>
				{#title_keywords#}
			</dt>
			<dt class="full_width">
				{$input_keywords}
			</dt>
			*}
			{*<dt>
				{#title_active#} {$input_active}
			</dt>*}
			<dt>
				{#title_user_name#}
			</dt>
			<dd>
				{$input_user_name}
			</dd>
			<dt>
				{#title_user_email#}
			</dt>
			<dd>
				{$input_user_email}
			</dd>
			<dt>
				{#title_user_nr#}
			</dt>
			<dd>
				{$input_user_nr}
			</dd>
			
			
			
			
			
			<br/>
			<dt>
				{#title_file_ev#}
			</dt>
			<dd>
				<div id="currentfilelist"></div>
				<div id="filelist"></div>
				<div id="container">
					<a id="pickfiles">{#pick_files#}</a>
				</div>
			</dd>
			
			<dt>&nbsp;</dt>
			<dt class="full_width nomarg free_height">
				{$hidden}
				{$input_cat_id}
				<div class="save_edit_filelist">
					<a class="ext_button red f_14" href="#">
						<i style="background-image: url(images/icons/ico_1.png)" class="ico right"></i>
						<span>{#prompt_save#}</span>
					</a>
				</div>
			</dt>
		</dl>
	{$end_form}
</div>