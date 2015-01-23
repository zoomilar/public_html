<link type="text/css" href="{root_url}/modules/FrontEndUsers/js/ui.multiselect.css" rel="stylesheet" />
<script type="text/javascript" src="{root_url}/modules/FrontEndUsers/js/ui.multiselect.js"></script>
{literal}
<script>
	var parent_val = '';
	
	var $addall = '{/literal}{$mod->Lang("multiselect_addall")}{literal}';
	var $remall = '{/literal}{$mod->Lang("multiselect_remall")}{literal}';
	var $ieskoti = '{/literal}{$mod->Lang("multiselect_ieskoti")}{literal}';
	
	$(document).ready(function() {
		$('select[name="m1_user_group"]').focus(function () {
			parent_val = $(this).val();
		}).change(function(e) {
			if ($('select[name="m1_user[]"] option:selected').length > 0) {
				if (!confirm('{/literal}{$mod->Lang("confirm_chenge_user_group")}{literal}')) {
					$(this).val(parent_val);
					parent_val = '';
					e.preventDefault();
					return false;
				}
			}
			$.get('/ajax.php', {'action': 'get_user_list', 'gid': $(this).val()}, function(d) {
				$('select[name="m1_user[]"]').html(d);
			});
		});
		if($.isFunction($.fn.multiselect)) {
			$(".superselect select").multiselect();
		}
	});
</script>
{/literal}

{$startform}
	{$msg_id}
  <div class="pageoverflow">
    <p class="pagetext">{$mtitle_title}</p>
    <p class="pageinput">{$title}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mtitle_content}</p>
    <p class="pageinput">{$content}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mtitle_user_group}</p>
    <p class="pageinput">{$user_group}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mtitle_active}</p>
    <p class="pageinput">{$active}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mtitle_priority}</p>
    <p class="pageinput">{$priority}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mtitle_ex_date}</p>
    <p class="pageinput">{$ex_date}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mtitle_user}</p>
    <p class="pageinput superselect">{$user}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mtitle_where}</p>
    <p class="pageinput">{$where}</p>
  </div>

  <div class="pageoverflow">
    <p class="pagetext">&nbsp;</p>
    <p class="pageinput">{$submit}</p>
  </div>
{$endform}