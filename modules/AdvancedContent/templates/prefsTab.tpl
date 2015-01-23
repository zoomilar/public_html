{*------------------------------------------------------------------------------

Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
         a content management tool for CMS Made Simple
         The projects homepage is http://dev.cmsmadesimple.org/projects/content2
         CMS Made Simple is (c) 2004-2013 by Ted Kulp (wishy@cmsmadesimple.org)
         The projects homepage is: http://www.cmsmadesimple.org
Version: 0.9.4
File   : prefsTab.tpl
License: GPL

------------------------------------------------------------------------------*}
{literal}
<script type="text/javascript">
(function($){
	var selectors = ['ac_use_advanced_pageoptions'];
	$(document).ready(function(){
		for(var i=0; i<selectors.length; i++) {
			$("#" + selectors[i]).change(function() {
				var v = this.checked;
				$('.' + this.id).each(function(){
					var $this = $(this),
						a = $this.hasClass('ac_value_' + v),
						m = (a && v);
					if(m) {
						console.log('show');
						$this.find('input, select, option, textarea, optgroup').removeAttr('disabled');
						$this.slideDown();
					}
					else {
						console.log('hide');
						$this.slideUp();
						$this.find('input, select, option, textarea, optgroup').attr('disabled', 'disabled');
					}
				});
			});
		}
	});
})(jQuery);
</script>
{/literal}

{$startform}
<div class="pageoverflow">
	<p class="pagetext">{$hide_deprecated_text}:</p>
	<p class="pageinput">{$hide_deprecated_input}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">{$block_display_settings_text}:</p>
	<p class="pageinput">{$block_display_settings_input}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">{$collapse_block_default_text}:</p>
	<p class="pageinput">{$collapse_block_default_input}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">{$message_display_settings_text}:</p>
	<p class="pageinput">{$message_display_settings_input}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">{$group_display_settings_text}:</p>
	<p class="pageinput">{$group_display_settings_input}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">{$collapse_group_default_text}:</p>
	<p class="pageinput">{$collapse_group_default_input}</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">{$use_advanced_pageoptions_text}:</p>
	<p class="pageinput">{$use_advanced_pageoptions_input}</p>
</div>
<br />
<div class="pageoverflow ac_use_advanced_pageoptions ac_value_true"{if !$use_advanced_pageoptions} style="display:none"{/if}>
	<fieldset>
		<legend>{$contentsettings_text}</legend>
		<div class="pageoverflow">
			<p class="pagetext">{$use_expire_date_text}:</p>
			<p class="pageinput">{$use_expire_date_input}</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">{$start_date_text}:</p>
			<p class="pageinput">{$start_date_input}</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">{$end_date_text}:</p>
			<p class="pageinput">{$end_date_input}</p>
		</div>
	{if isset($feuaccess_text)}
		<div class="pageoverflow">
			<p class="pagetext">{$feuaccess_text}:</p>
			<p class="pageinput">{$feuaccess_input}</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">{$redirectpage_text}:</p>
			<p class="pageinput">{$redirectpage_input}</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">{$feu_params_text}:</p>
			<p class="pageinput">
				{$inherit_text} : {$inherit_feu_params_input}<br /><br />
				{$feu_params_input}&nbsp;<em>(param1=value1 param2=value2 ...)</em><br /><br />
				{$evaluatesmarty_text}:&nbsp;{$feu_params_smarty_input}
			</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">{$custom_params_text}:</p>
			<p class="pageinput">
				{$inherit_text} : {$inherit_custom_params_input}<br /><br />
				{$custom_params_input}&nbsp;<em>(param1=value1 param2=value2 ...)</em><br /><br />
				{$evaluatesmarty_text}:&nbsp;{$custom_params_smarty_input}
			</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">{$feuaction_text}:</p>
			<p class="pageinput">{$feuaction_input}</p>
		</div>
		<div class="pageoverflow">
			<p class="pagetext">{$hide_menu_item_text}:</p>
			<p class="pageinput">{$hide_menu_item_input}</p>
		</div>
	{/if}
	</fieldset>
</div>
<div class="pageoverflow">
	<p class="pagetext"></p>
	<p class="pageinput">{$submit_prefs}</p>
</div>
{$endform}
