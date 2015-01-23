<link type="text/css" href="{root_url}/modules/Filelists/lib/multiselect/ui.multiselect.css" rel="stylesheet" />
<script type="text/javascript" src="{root_url}/modules/Filelists/lib/multiselect/ui.multiselect.js"></script>
<link type="text/css" href="{root_url}/modules/Filelists/lib/timepicker/jquery.datetimepicker.css" rel="stylesheet" />
<script type="text/javascript" src="{root_url}/modules/Filelists/lib/timepicker/jquery.datetimepicker.js"></script>

<script src="{root_url}/modules/Filelists/lib/uploader/plupload.full.min.js" type="text/javascript"></script>
<script src="{root_url}/modules/Filelists/filelists.js" type="text/javascript"></script>
<script src="{root_url}/js/tx.preloader.js" type="text/javascript"></script>
{literal}
<script>
	
var $addall = '{/literal}{$mod->Lang("multiselect_addall")}{literal}';
var $remall = '{/literal}{$mod->Lang("multiselect_remall")}{literal}';
var $ieskoti = '{/literal}{$mod->Lang("multiselect_ieskoti")}{literal}';

var delete_image = '{/literal}{$mod->lang("delete_image")}{literal}';
var delete_image2 = '{/literal}{$mod->lang("delete_image2")}{literal}';
var root_url = '{/literal}{root_url}{literal}';
var filelist_id = '{/literal}{if isset($filelist_id)}{$filelist_id}{else}{$filelist_id_tmp}{/if}{literal}';


	
$(document).ready(function () {
	$('[data-input="date"]').datepicker({ 
		dateFormat: "yy-mm-dd",
		firstDay: 1
	});
	
	$('[data-input="time"]').datetimepicker({
		datepicker:false,
		format:'H:i'
	});
	
	if($.isFunction($.fn.multiselect)) {
		$(".superselect select").multiselect();
	}
	
	get_current_files(filelist_id);
	init_the_uploader(filelist_id);
	
	get_current_files2(filelist_id);
	init_the_uploader2(filelist_id);
});
</script>
{/literal}
{$start_form}
	<div class="pageoverflow">
	   <p class="pagetext">{$title_filename}</p>
	   <p class="pageinput">{$input_filename}</p>
	</div>
	{*<div class="pageoverflow">
	   <p class="pagetext">{$title_date}</p>
	   <p class="pageinput">{$input_date}</p>
	</div>
	<div class="pageoverflow">
	   <p class="pagetext">{$title_time_start}</p>
	   <p class="pageinput">{$input_time_start}</p>
	</div>
	<div class="pageoverflow">
	   <p class="pagetext">{$title_date_end}</p>
	   <p class="pageinput">{$input_date_end}</p>
	</div>
	<div class="pageoverflow">
	   <p class="pagetext">{$title_time_end}</p>
	   <p class="pageinput">{$input_time_end}</p>
	</div>*}
	<div class="pageoverflow">
	   <p class="pagetext">{$title_location}</p>
	   <p class="pageinput">{$input_location}</p>
	</div>
	{*<div class="pageoverflow">
	   <p class="pagetext">{$title_detail}</p>
	   <p class="pageinput">{$input_detail}</p>
	</div>
	<div class="pageoverflow">
	   <p class="pagetext">{$title_cooking_course}</p>
	   <p class="pageinput">{$input_cooking_course}</p>
	</div>
	<div class="pageoverflow">
	   <p class="pagetext">{$title_short_desc}</p>
	   <p class="pageinput">{$input_short_desc}</p>
	</div>*}
	<div class="pageoverflow">
	   <p class="pagetext">{$title_file_t2}</p>
	   <p class="pageinput">{$input_file2}</p>
	</div>
	<div class="pageoverflow">
	   <p class="pagetext">{$title_keywords}</p>
	   <p class="pageinput">{$input_keywords}</p>
	</div>
	{*<div class="pageoverflow">
	   <p class="pagetext">{$title_admin_msg}</p>
	   <p class="pageinput">{$input_admin_msg}</p>
	</div>*}
	<div class="pageoverflow">
	   <p class="pagetext">{$title_active}</p>
	   <p class="pageinput">{$input_active}</p>
	</div>
	{*<div class="pageoverflow">
	   <p class="pagetext">{$title_deleted}</p>
	   <p class="pageinput">{$input_deleted}</p>
	</div>
	<div class="pageoverflow">
	   <p class="pagetext">{$title_needs_registration}</p>
	   <p class="pageinput">{$input_needs_registration}</p>
	</div>
	<div class="pageoverflow">
	   <p class="pagetext">{$title_user_id}</p>
	   <p class="pageinput">{$input_user_id}</p>
	</div>*}
	
	<div class="pageoverflow">
		<p class="pagetext">{$title_file}</p>
		<p class="pageinput">
			<div id="currentfilelist"></div>
			<div id="filelist"></div>
			<div id="container">
				<a id="pickfiles">{$mod->Lang('pick_files')}</a>
			</div>
		</p>
	</div>
	
	<div class="pageoverflow">
		<p class="pagetext">{$title_file2}</p>
		<p class="pageinput">
			<div id="currentfilelist2"></div>
			<div id="filelist2"></div>
			<div id="container2">
				<a id="pickfiles2">{$mod->Lang('pick_files2')}</a>
			</div>
		</p>
	</div>
	
	{*<div class="pageoverflow">
	   <p class="pagetext">{$title_user_name}</p>
	   <p class="pageinput superselect">{$input_user_name}</p>
	</div>
	<div class="pageoverflow">
	   <p class="pagetext">{$title_user_email}</p>
	   <p class="pageinput superselect">{$input_user_email}</p>
	</div>
	<div class="pageoverflow">
	   <p class="pagetext">{$title_user_nr}</p>
	   <p class="pageinput superselect">{$input_user_nr}</p>
	</div>*}
	<div class="pageoverflow">
	   <p class="pagetext">{$title_cat_id}</p>
	   <p class="pageinput superselect">{$input_cat_id}</p>
	</div>
	
	
	
	<div class="pageoverflow">
	   <p class="pagetext"></p>
	   <p class="pageinput check_filelist_submit">{$submit}&nbsp;{$cancel}</p>
	</div>
	{if $has_reg}
		<div class="pageoverflow">
		   <p class="pagetext">
				<a href="{root_url}/download.php?action=FilelistGetRegList&id={$filelist_id}">
					<span>{$mod->Lang('download_reg')}</span>
					<span></span>
				</a>
			</p>
		</div>
	{/if}
{$end_form}