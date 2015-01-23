<?php
$lang['AdvancedContent'] = 'Napredne Vsebine';
$lang['advancedcontent_tabname'] = 'Napredne Nastavitve';
$lang['installed'] = 'Module NapredneVsebine %s je instaliran';
$lang['uninstalled'] = 'Module NapredneVsebine %s zbrisan';
$lang['upgraded'] = 'Module AdvancedContent upgraded to %s';
$lang['postinstall'] = 'Module AdvancedContent %s installed.';
$lang['postuninstall'] = 'Module AdvancedContent %s uninstalled.';
$lang['confirmuninstall'] = 'Do you really want uninstall the module AdvancedContent?';
$lang['notice_duplicatecontent'] = '<em><strong>Notice:</strong> This block is used multiple times in template. You only see the first block here.</em>';
$lang['error_basicattrib'] = '<em><strong>Notice:</strong> Cannot use basic content property name &#039;%s&#039; as value of param &#039;block&#039;. <br />This block is disabled. Check your page template and chose a different value of param &#039;block&#039;.</em>';
$lang['error_expiredate'] = 'End date must be later than start date.';
$lang['youareintext'] = 'Current directory';
$lang['dimensions'] = 'Imagesize';
$lang['size'] = 'Filesize';
$lang['inherit_from_parent'] = 'Inherit from parent';
$lang['none'] = 'none';
$lang['invalid'] = 'invalid';
$lang['invalid_blocktype'] = '<em><strong>Notice:</strong> Invalid value &#039;%s&#039; of param block_type in block &#039;%s&#039;.<br />Check your page template.</em>';
$lang['error_insufficient_blockparams'] = '<em><strong>Error:</strong> Insufficient params. <br />Missing param &#039;%s&#039; for block &#039;%s&#039;. Check your page template.</em>';
$lang['yes'] = 'Yes';
$lang['no'] = 'No';
$lang['frontendaccess'] = 'Frontend access';
$lang['redirectpage'] = 'Redirect Page if no access';
$lang['showloginform'] = 'Show login form';
$lang['registeredusers'] = 'Registered users only';
$lang['block'] = 'Block';
$lang['useexpiredate'] = 'Use expire date';
$lang['startdate'] = 'Start Date';
$lang['enddate'] = 'End Date';
$lang['blockcontent'] = 'Block Content';
$lang['setpageinactive'] = 'Set Page to Inactive';
$lang['deletepage'] = 'Delete Page';
$lang['uninstallaction'] = 'Uninstall action';
$lang['setcontent1'] = 'Set all Pages of AdvancedContent back to type Content';
$lang['setcontent2'] = 'Set all Pages of AdvancedContent back to type Content and remove additional content blocks';
$lang['prefsupdated'] = 'Preferences updated';
$lang['success'] = 'Ok';
$lang['error'] = 'Error';
$lang['deletepages'] = 'Delete all pages of type AdvancedContent';
$lang['importpages'] = 'Set all Pages of type %s to type %s.';
$lang['pagesimported'] = 'All content pages set to AdvancedContent.';
$lang['confirmimport'] = 'Do you really want to change the content type of all content pages?';
$lang['toggle_message'] = 'Hide this message';
$lang['contentsettings'] = 'Default AdvancedContent settings';
$lang['redirectparams'] = 'URL params to append when redirecting';
$lang['evaluatesmarty'] = 'Use smarty to process the params';
$lang['error_loading_module'] = '<em><strong>Error:</strong> Could not load module &#039;%s&#039;. (Defined for block &#039;%s&#039; in your page template.)</em>';
$lang['error_contentblock_support'] = '<em><strong>Error:</strong> Module &#039;%s&#039; does not support contentblocks. (Defined for block &#039;%s&#039; in your page template.)</em>';
$lang['success_importpages'] = 'All pages of type %s succesfully changed to %s';
$lang['show_advancedcontent_options'] = 'Show AdvancedContent options tab';
$lang['display_settings'] = '%s display settings';
$lang['save_collapse_status'] = 'Save collpase status of %s';
$lang['content_blocks'] = 'content blocks';
$lang['block_message'] = 'content block message';
$lang['block_groups'] = 'block groups';
$lang['collapse_default'] = 'Collapse %s by default';
$lang['per_page'] = 'per page';
$lang['per_template'] = 'per template';
$lang['both1'] = 'template OR page ';
$lang['both2'] = 'template AND page';
$lang['content'] = 'Content';
$lang['content2'] = 'Advanced Content';
$lang['prefs'] = 'Preferences';
$lang['multi_input'] = 'Multi Inputs';
$lang['multi_input_tpl'] = 'Multi Input Templates';
$lang['add_multi_input'] = 'Add new multi input';
$lang['add_multi_input_tpl'] = 'Add new multi input template';
$lang['input_id'] = 'Input ID';
$lang['input_fields'] = 'Input fields';
$lang['tpl_name'] = 'Template name';
$lang['error_template'] = 'Template is a required field and may not be empty';
$lang['error_input_fields'] = 'Input fields is a required field and may not be empty.';
$lang['error_input_id'] = 'No input id given or input id already exists.';
$lang['error_input_id_exists'] = 'Input ID is already in use. Choose a different one. (must be unique)';
$lang['multi_input_added'] = 'Multi Input added.';
$lang['multi_input_deleted'] = 'Multi Input deleted.';
$lang['multi_input_updated'] = 'Multi Input updated.';
$lang['multi_input_tpl_added'] = 'Multi Input template added.';
$lang['multi_input_tpl_updated'] = 'Multi Input template updated.';
$lang['multi_input_tpl_deleted'] = 'Multi Input template deleted.';
$lang['delete_selected'] = 'Delete selected items';
$lang['confirm_delete'] = 'Do you really want do delete this item?';
$lang['confirm_delete_selected'] = 'Do you really want do delete the selected items?';
$lang['use_contenttype'] = 'Use contenttype';
$lang['help_tpl_vars'] = '<p><strong>Template vars:</strong></p>
<p><pre><code>{$inputs}</code></pre> is an array that contains all defined input elements of that multi input block.<br />
Each input element is an array that contains all its params. <br />
See module help for more info.<br />
Additional param is &quot;input&quot; that will print out the input element.<br />
To access the params use the dot syntax.<br />
Example:</p>
<pre><code>{foreach from=$inputs item=elm}
	{$elm.label}:&nbsp;{$elm.input}<br />
{/foreach}</code></pre>';
$lang['help'] = '<br />
<h3>What does this do?</h3>
<p>This is a modification of the default content type &quot;Content&quot; of CMSms.<br />
It provides more flexibility by creating custom input controls in backend.<br />
Users can add dropdowns, multiple select lists, checkboxes, group content blocks 
in separate page tabs, block tabs inside a page tab or in fieldsets by just 
using additional params in the template when calling the content.<br />
It also adds ability to grant access of pages to certain users of the 
FrontEndUsers module and hide the content, replace it by the login form of the 
FrontEndUsers module or redirect to a specified page showing the login form or 
just redirect without doing anything else.<br />
Page property of FrontEndUsers access and redirect page can be inherited by 
parent pages.</p>
<p>You can even use smarty logic in parameter values. That means you can use the 
result of a plugin, an udt or even a module or just the content of a global 
content block as parameter value to create dynamic values.</p>
<h3>How is it used?</h3>
<p>After installation the module settings can be found in &quot;Extensions->AdvancedContent&quot;.</p>
<p>Additionally you will have a new content type &quot;AdvancedContent&quot; available 
when adding/editing a page.<br />
<p>Add the following params to your content tag in your page template, 
change the content type of your page to &quot;AdvancedContent&quot; and see what happens 
in backend...</p>
<h3>What parameters are available?</h3>
<p>all params are optional</p>
<p><strong>Default params:</strong></p>
<ul>
	<li>
		<em>(optional)</em> <tt>block</tt> (string)
		<ul>
			<li>
				Allows you to have more than one content block per page. If multiple content tags are put on a template, that number of edit boxes will be displayed if the page is edited.<br />
				e.g.: <code>{content block=&quot;Second Content block&quot;}</code><br />
				Now, if you edit a page there will ba a textarea called &quot;Second Content block&quot;.<br />
				<em><strong>Notice:</strong> The name of the content block may contain only letters, numbers, and underscores (no whitespaces, special chars, umlauts etc.). Otherwise it will be converted to a proper name (similar to the page alias).</em>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>wysiwyg</tt> (true/false)
		<ul>
			<li>If set to false, then a wysiwyg will never be used while editing this block. If true, then it acts as normal.</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>oneline</tt> (true/false)
		<ul>
			<li>If set to true, then only one edit line will be shown while editing this block. If false, then it acts as normal. Only works when block parameter is used.</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>default</tt> (string)
		<ul>
			<li>Default content when creating a new page.</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>label</tt> (string)
		<ul>
			<li>Prompt for this content block. Possible values are any expression. If blank, the unconverted block name is used.</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>assign</tt> (string)
		<ul>
			<li>
				Assigns the content to a smarty parameter, which you can then use in other areas of the page, or use to test whether content exists in it or not.<br />
				Example of passing page content to a User Defined Tag as a parameter:<br />
				<code>{content assign=pagecontent}<br />
				{table_of_contents thepagecontent=&quot;$pagecontent&quot;}</code><br />
				<em><strong>Notice:</strong> For some reason this param does not work at the moment with the module plugin {AvancedContent}. Use <br /><code>{capture assign=&quot;foo&quot;}{AdvancedContent}{/capture}</code> <br />instead.</em>
			</li>
		</ul>
		<br />
	</li>
</ul>
<p><strong>Advanced params:</strong></p>
<ul>
	<li>
		<em>(optional)</em> <tt>block_type</tt> (text,checkbox,dropdown,select_multiple,date,multi_input) 
		<ul>
			<li>Allows you to specify what content control type is used in the back end.</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>page_tab</tt> (string)
		<ul>
			<li>
				This parameter sets the tab in which the content block is displayed in the backend.<br />
				Possible values are &quot;main&quot; ( = Tab &quot;Main Menu&quot;), &quot;options&quot; ( = Tab &quot;Options&quot;), or any other arbitrary value<br />
				<em>e.g. you can add a checkbox to the options tab or create new tabs</em>.
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>block_tab</tt> (string)
		<ul>
			<li>With this parameter, the blocks within a page tab can be further divided into tabs or can be grouped together. Any expression can be used as a possible value.</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>block_group</tt> (string)
		<ul>
			<li>With this parameter, multiple blocks can be grouped in a fieldset. Any expression can be used as a possible value.</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>active</tt> (true/false)
		<ul>
			<li>
				Allows you to disable a content block. Disabled content blocks won&#039;t be shown in backend as well as in frontend. (only works with {AdvancedContent} plugin)<br />
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>editor_groups</tt> (string)
		<ul>
			<li>
				A comma separated list of group names that are allowed to edit this block.
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>editor_users</tt> (string)
		<ul>
			<li>
				A comma separated list of user names that are allowed to edit this block.
			</li>
		</ul>
		<br />
	</li>
	<em><strong>Notice:</strong> if the params <tt>editor_users</tt> and <tt>editor_groups</tt> are empty the block may be edited by any user with sufficient permission to edit a page</em><br /><br />
	<li>
		<em>(optional)</em> <tt>feu_access</tt>
		<ul>
			<li>
				A list of feu group ids separated by a comma.<br />
				This shows the content block only to certain feu groups.<br />
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>feu_action</tt> (true/false)
		<ul>
			<li>
				Specify if the login form of the feu module will be shown or not.<br />
				<em><strong>Notice:</strong> The login form will only be shown one time.<br />
				If there are multiple blocks with limited feu_access and feu_action set to true only the first blocks login form will be shown and all other blocks will just be empty.</em><br />
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>allow_none</tt> (true/false)
		<ul>
			<li>Set to true if the user may enter empty values. <br />If set to false and value is empty the default value of the param &quot;default&quot; will be used. <br />If set to true and block is of type image/file the option &quot;none&quot; (mode=&quot;dropdown&quot;) or a button to clear the selected file/image value (mode=&quot;filepicker&quot;) will be displayed.</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>smarty</tt> (true/false)
		<ul>
			<li>
				Turn smarty processing of values on/off.<br />
				If set to true any given value will be processed by the smarty engine.<br />
				<em><strong>Notice: </strong> Consider that you cannot use the default smarty delimiters that are used in the template. This will cause smarty errors in frontend.<br />
				So you need to use ::: as delimiter instead.<br /></em>
				E.g.: <code>{content block=&quot;Categories&quot; label=&quot;Select a category&quot; block_type=&quot;dropdown&quot; items=&quot;:::global_content name=&#039;categorylist&#039;:::&quot; smarty=&quot;true&quot;}</code>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>description</tt> (string) 
		<ul>
			<li>Allows you to add a detailed description to that block for your editors.</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>collapse</tt> (true/false)
		<ul>
			<li>
				Set to true/false to display block in backend in collapsed/expanded mode by default.<br />
				<em><strong>Notice:</strong> will be always false if no_collapse=true is used.</em><br />
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>no_collapse</tt> (true/false)
		<ul>
			<li>
				Set to false to disable folding of blocks.<br />
				<em><strong>Notice:</strong> if set to true param collapse is always false.</em><br />
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>required</tt> (true/false)
		<ul>
			<li>
				Set to true if this block may not be empty.<br />
			</li>
		</ul>
		<br />
	</li>
</ul>
<p><strong>Params of blocktype &quot;checkbox&quot;:</strong></p>
<ul>
	<li>
		<em>(optional)</em> <tt>default</tt> (true/false) 
		<ul>
			<li>
				checks/unchecks the checkbox by default when adding a page<br />
				<em><strong>Notice:</strong> Use &quot;1&quot; for checked and &quot;0&quot; for unchecked by default<br /></em>
				E.g. <code>{content block_type=&quot;checkbox&quot; default=1}</code>
			</li>
		</ul>
		<br />
	</li>
</ul>
<p><strong>Params of blocktype &quot;dropdown&quot;/&quot;select_multiple&quot;:</strong></p>
<ul>
	<li>
		<em>(optional)</em> <tt>items</tt> (string)
		<ul>
			<li>Item label(s) of the field(s) (separated by a delimiter - default is | (pipe))</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>values</tt> (string)
		<ul>
			<li>Value(s) of the items (separated by a delimiter - default is | (pipe))</li>
		</ul>
		<br />
	</li>
	<em><strong>Notice:</strong> if there are less values than items the item labels will be used as values (and vise versa).</em><br /><br />
	<li>
		<em>(optional)</em> <tt>default</tt> (string)
		<ul>
			<li>
				Preselected value(s) (separated by a delimiter - default is | (pipe))<br />
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>delimiter</tt> (string)
		<ul>
			<li>A sign or string that will be used to devide the items/values (default is | (pipe))</li>
		</ul>
		<br />
	</li>
	<li><em>(optional)</em> <tt>size</tt> (integer)
		<ul>
			<li>Height of content block in back end if <code>block_type=&quot;select_multiple&quot;</code> is set. <em>(Default is number of items)</em></li>
		</ul>
		<br />
	</li>
	<li><em>(optional)</em> <tt>sortable_items</tt> (true/false) - select_multiple only
		<ul>
			<li>
				If set to true the items won&#039;t be shown as a multiple select input with options but as a list of checkboxes that can be reordered.<br />Each row contains the item label and a checkbox with the item value.<br />
				<em><strong>Notice:</strong> only the order of the <strong>selected</strong> items will be stored and always displayed on the top of the list when reloading the edit page.<br />
				Unselected items will appended in that order they are defined in the template</em>
			</li>
		</ul>
		<br />
	</li>
</ul>
<p><strong>Params of blocktype &quot;date&quot;:</strong></p>
<ul>
	<li>
		<em>(optional)</em> <tt>step_hours</tt> (int) 
		<ul>
			<li>
				steps of hours in the clock dropdown. (default is 1)
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>start_hour</tt> (int) 
		<ul>
			<li>
				the start hour of the clock dropdown. (default is 0)
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>end_hour</tt> (int) 
		<ul>
			<li>
				the end hour of the clock dropdown (default is 12 or 23)
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>show24h</tt> (true/false) 
		<ul>
			<li>
				set to false if AM/PM is used. (default is true)
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>step_minutes</tt> (int) 
		<ul>
			<li>
				steps of minutes in the clock dropdown. (default is 10)
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>start_minute</tt> (int) 
		<ul>
			<li>
				the start minute of the clock dropdown. (default is 0)
			</li>
		</ul>
		<br />
	</li>
		<em>(optional)</em> <tt>end_minute</tt> (int) 
		<ul>
			<li>
				the end minute of the clock dropdown (default is 59)
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>show_clock</tt> (true/false) 
		<ul>
			<li>
				set to false if no time dropdown should be displayed (default is true)<br />
				<em><strong>Notice:</strong> If set to false 00:00 o&#039;clock will be used</em>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>date_format</tt> (string) 
		<ul>
			<li>
				The strftime date format to show in frontend.
			</li>
		</ul>
		<br />
	</li>
</ul>
<p><strong>Params of blocktype &quot;multi_input&quot;:</strong></p>
<ul>
	<li>
		<em>(optional)</em> <tt>inputs</tt> (csv of input ids you created in the backend) 
		<br /><br />
	</li>
	<li>
		<em>(optional)</em> <tt>value_delimiter</tt> (any string) 
		<ul>
			<li>
				This defines a string that devides the values of the inputs of one multi_input when stored in the database.<br />
				Default is &quot;<!-- multi_input_value_dellimiter -->&quot;
			</li>
		</ul>
		<br />
	</li>
	<li>
		<em>(optional)</em> <tt>input_delimiter</tt> (any string) 
		<ul>
			<li>
				This defines a string that devides the multi_inputs you defined for this content block when stored in the database.<br />
				Default is &quot;<!-- multi_input_dellimiter -->&quot;
			</li>
		</ul>
		<br />
	</li>
	<li>
		<p><strong>What is a multi_input for?</strong></p>
		<p>A multi_input block is a content block that consists of different input fields. <br />
		You can define them in the module administration using the same syntax you use in a template when defining a content block.<br />
		Multi inputs can be used if you want to store different values in one content block and provide different input types for each values.<br />
		This can be usefull if you want to create a dropdown to select a module to be shown in frontend and text input to define the module parameters.<br />
		Example for a multi_input in page template:</p>
		<pre>
		<code>
		{content block=&quot;module&quot; label=&quot;Page modules&quot; block_type=&quot;multi_input&quot; inputs=&quot;module,module,module,module&quot;}
		</code>
		</pre>
		<p>Example for the definition of the multi_input named &quot;module&quot;:</p>
		<pre>
		<code>
		{content block=&quot;module selection&quot; block_type=&quot;dropdown&quot; items=&quot;|News|Gallery|Menu&quot;}
		{content block=&quot;module params&quot; block_type=&quot;text&quot; oneline=true}
		</code>
		</pre>
		<p>What happens if you edit a page?</p>
		<p>It will show you a fieldset with legend &quot;Page modules&quot;. <br />
		Inside this fieldset it shows the multi_input named &quot;module&quot; four times.<br />
		That means you see four lines with two input fields. A dropdown and a text input.</p>
		<p>What happens if you save a page?</p>
		<p>The module stores the values as one single content property (aka contentblock) and separates the inputs by a given delimiter.<br />
		Let&#039;s assume you select the News module four times with different module params like category=&quot;1&quot;, category=&quot;2&quot;, category=&quot;3&quot;, category=&quot;4&quot;.<br />
		In the database it stores this string:</p>
		<pre>
		<code>
		News<!-- multi_input_value_delimiter -->category=&quot;1&quot;<!-- multi_input_delimiter --><br />
		News<!-- multi_input_value_delimiter -->category=&quot;2&quot;<!-- multi_input_delimiter --><br />
		News<!-- multi_input_value_delimiter -->category=&quot;3&quot;<!-- multi_input_delimiter --><br />
		News<!-- multi_input_value_delimiter -->category=&quot;4&quot;
		</code>
		</pre>
		<p>In your page template you can explode the content by the delimiters and call the selected modules.</p>
		<p>Full Example:</p>
		<pre>
		<code>
		{* define the content block *}
		{content block=&quot;my_modules&quot; block_type=&quot;multi_input&quot; inputs=&quot;Module,Module,Module,Module&quot; assign=&quot;modules&quot;}
		
		{* explode block content in an array to get the input groups *}
		{assign var=modules value=&quot;<!-- multi_input_delimiter -->&quot;|explode:$modules}
		
		{* loop through the selected modules *}
		{foreach from=$modules item=&quot;module&quot;}
			{if $module != &#039;&#039;}
			
				{* explode the input values in modulname and module parameters *}
				{assign var=module_items value=&quot;<!-- multi_input_value_delimiter -->&quot;|explode:$module}
				
				{if$module_items[0] != &#039;&#039;}
				
					{* call the module *}
					{if isset($module_items[1])}
						{eval var=$smarty.ldelim|cat:&#039;cms_module module=&quot;&#039;|cat:$module_items[0]|cat:&#039;&quot; &#039;|cat:$module_items[1]|cat:$smarty.rdelim}
					{else}
						{eval var=$smarty.ldelim|cat:&#039;cms_module module=&quot;&#039;|cat:$module_items[0]|cat:&#039;&quot;&#039;|cat:$smarty.rdelim}
					{/if}
					
				{/if}
				
			{/if}
		
		{/foreach}
		</code>
		</pre>
	</li>
</ul>

<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
	<li>The projects homepage is <a href="http://dev.cmsmadesimple.org/projects/content2/">http://dev.cmsmadesimple.org/projects/content2/</a></li>
	<li>Additional discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forums</a>.</li>
</ul>
<br />
<p>Feel free report any kind of feedback.</p>
<h3>Copyright and License</h3>
<p>
	As per the GPL, this software is provided as-is.<br />
	This program is distributed in the hope that it will be useful,<br />
	but WITHOUT ANY WARRANTY; without even the implied warranty of<br />
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.<br />
	See the GNU General Public License for more details.<br />
	You should have received a copy of the GNU General Public License<br />
	along with this program; if not, write to the Free Software<br />
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA<br />
	Or read it online: <a href="http://www.gnu.org/licenses/licenses.html#GPL">http://www.gnu.org/licenses/licenses.html#GPL</a><br />
	Please read the text of the license for the full disclaimer.
</p>
<p>Copyright &copy; 2010, Georg Busch (NaN). All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>
<br />';
$lang['changelog'] = '<br />
<p><strong>Module releases</strong>...</p>
<ul>
	<li><p><strong>0.7.1 (Nov 2010):</strong></p>
		<ul>
			<li><p>Bugfixes:</p>
				<ul>
					<li><p>- fixed bug item #5651</p></li>
				</ul>
			</li>
			<li><p>Features:</p>
				<ul>
					<li><p>- added param feu_access</p></li>
					<li><p>- added param feu_action</p></li>
					<li><p>- added param required</p></li>
				</ul>
			</li>
		</ul>
	</li>
	<li><p><strong>0.7 (Nov 2010):</strong></p>
		<ul>
			<li><p>Bugfixes:</p>
				<ul>
					<li><p>- compatibility bugfixes for CMSms 1.9+ (needs CMSms 1.9 minimum now)</p></li>
				</ul>
			</li>
			<li><p>Features:</p>
				<ul>
					<li><p>- added support of {content_module} tag</p></li>
					<li><p>- added param no_collapse</p></li>
				</ul>
			</li>
		</ul>
	</li>
	<li><p><strong>0.6.2 (Nov 2010):</strong></p>
		<ul>
			<li><p>Bugfixes:</p>
				<ul>
					<li><p>- minor bugfix (showed tabs of previous template when template was changed)</p></li>
				</ul>
			</li>
		</ul>
	</li>
	<li><p><strong>0.6.1 (Nov 2010):</strong></p>
		<ul>
			<li><p>Bugfixes:</p>
				<ul>
					<li><p>- several bugfixes</p></li>
					<li><p>- compatibility bugfixes for CMSms 1.9</p></li>
				</ul>
			</li>
			<li><p>Features:</p>
				<ul>
					<li><p>- added block_type multi_input</p></li>
				</ul>
			</li>
		</ul>
	</li>
	<li><p><strong>0.6 (Oct 2010):</strong></p>
		<ul>
			<li><p>Bugfixes:</p>
				<ul>
					<li><p>- several bugfixes</p></li>
				</ul>
			</li>
			<li><p>Features:</p>
				<ul>
					<li><p>- added param block_group</p></li>
				</ul>
			</li>
			<li><p>Misc:</p>
				<ul>
					<li><p>- Removed file picker (and associated block_types image/file) - use GBFilePicker instead.</p></li>
				</ul>
			</li>
		</ul>
	</li>
	<li><p><strong>0.5 (Sept 2010):</strong></p>
		<ul>
			<li><p>Bugfixes:</p>
				<ul>
					<li><p>fixed bug item #5292 (memory issue)</p></li>
					<li><p>fixed bug item #5254 (disable wysiwyg not working)</p></li>
					<li><p>fixed bug item #5310 (urlonly not working)</p></li>
					<li><p>fixed bug item #5311 (image paths not stored &#039;correctly&#039;)</p></li>
				</ul>
			</li>
			<li><p>Features:</p>
				<ul>
					<li><p>added feature request #5261 (Add sort to image type - notice the change of param filter)</p></li>
					<li><p>added params exclude_prefix, include_prefix, exclude_sufix, include_sufix</p></li>
					<li><p>added feature request #5253 (Text input to define add params to redirect function)</p></li>
					<li><p>added feature request #5240 (Default values of AdvancedContent page options)</p></li>
					<li><p>added feature request #5241 (put FeuAccess in Blocktab)</p></li>
				</ul>
			</li>
			<li><p>Misc:</p>
				<ul>
					<li><p>- AdvancedContent options are shown in separate tab</p></li>
					<li><p>- Added new permission to manage the AdvancedContent options tab</p></li>
					<li><p>- removed param filter (use new params instead)</p></li>
					<li><p>- path to files are stored relative to the uploads dir</p></li>
					<li><p>- param dir of block type file/image needs to be relative to the uploads dir only (there is no image uploads dir used anymore)</p></li>
				</ul>
			</li>
		</ul>
	</li>
	<li><p><strong>0.4.1 (August 2010):</strong></p>
		<ul>
			<li><p>Bugfixes:</p>
				<ul>
					<li><p>- #5151: fixed stylesheet issue with expand/collapse buttons of content blocks in IE/Safari.</p></li>
					<li><p>- #5162: PHP warnings if backend users without permission &quot;Manage All AdvancedContent Blocks&quot; open an advanced content page and multiple content blocks of same name were used in template.</p></li>
					<li><p>- fixed bug where extra fields could not be updated.</p></li>
					<li><p>- fixed bug where feu access did not work.</p></li>
				</ul>
			</li>
			<li><p>Features:</p>
				<ul>
					<li><p>- added param &quot;delete&quot; to let users delete files even if no permission &quot;Modify Files&quot;</p></li>
					<li><p>- added param &quot;create_dirs&quot; to let users create_dirs even if no permission &quot;Modify Files&quot;</p></li>
					<li><p>- added new blocktype &quot;note&quot; to create some single notes for your editors</p></li>
				</ul>
			</li>
			<li><p>Misc:</p>
				<ul>
					<li><p>- removed dependency of FileManager</p></li>
					<li><p>- block of type file or image stores relative url now</p></li>
					<li><p>- block type image shows thumbnail in backend preview instead of full image</p></li>
				</ul>
			</li>
		</ul>
	</li>
	<li><p><strong>0.4 (July 2010):</strong></p>
		<ul>
			<li><p>Important notice:</p>
				<ul>
					<li><p>- changed param &quot;type&quot; to &quot;block_type&quot; since it interferes with {content_module} tag</p></li>
				</ul>
			</li>
			<li><p>Bugfixes:</p>
				<ul>
					<li><p>- #5101: page_tab &quot;options&quot; was shown to users with no permission to edit page options if a content block was assigned to that tab.</p></li>
					<li><p>- #5097: link to missing css removed</p></li>
					<li><p>- fixed mime-type issue (added preference to toggle mime-type usage on/off)</p></li>
					<li><p>- fixed path issue where thumbnails were not shown</p></li>
					<li><p>- fixed compatibility with CMSms 1.8</p></li>
					<li><p>- other minor bugfixes</p></li>
				</ul>
			</li>
			<li><p>Features:</p>
				<ul>
					<li><p>- added MLE support</p></li>
					<li><p>- added param &quot;show_clock&quot; to enable/disable the time dropdown of blocktypes &quot;date&quot; in backend</p></li>
					<li><p>- added param &quot;date_format&quot; to format timestamp of blocktypes &quot;date&quot; in frontend</p></li>
					<li><p>- added param &quot;description&quot;</p></li>
					<li><p>- added bulk function to set all pages to AdvancedContent</p></li>
					<li><p>- added compatibility with {content_module} tag</p></li>
				</ul>
			</li>
		</ul>
	</li>
	<li><p><strong>0.3.4 (June 2010):</strong></p>
		<ul>
			<li><p>Bugfixes:</p>
				<ul>
					<li><p>- #5045: When switching from Content -> Advanced Content lots of PHP errors</p></li>
					<li><p>- #5056: page_tabs not working for users without permission &quot;Manage All Content&quot;</p></li>
					<li><p>- #5073: incorrect display of files when opening filepicker</p></li>
					<li><p>- fixed minor bug where the option &quot;allow_none&quot; of content blocks of type image/file was not shown when template has been edited</p></li>
				</ul>
			</li>
			<li><p>Features:</p>
				<ul>
					<li><p>- added filemanagement and upload functions to content blocks of type image/file</p></li>
					<li><p>- added breadcumbs to filepicker</p></li>
					<li><p>- admins may browse the entire dir tree in filepicker file browser regardless of template params</p></li>
					<li><p>- added mime type checking to get file type</p></li>
					<li><p>- added rawurlencode in src attribs to display images with weird filenames.</p></li>
				</ul>
			</li>
			<li><p>miscellaneous:</p>
				<ul>
					<li><p>- removed OOP stuff (private/public/protected) to gain more compatibility with PHP4</p></li>
					<li><p>- changed ajax functions to return xml values</p></li>
					<li><p>- removed usage of ImageManager once and for all. (caused only trouble)</p></li>
				</ul>
			</li>
		</ul>
	</li>
	<li><p><strong>0.3.3 (June 2010):</strong></p>
	<ul>
		<li><p>Bugfixes:</p>
			<ul>
				<li><p>- alias was not always converted properly</p></li>
				<li><p>- unsubmitted content got lost if switching from Content to AdvancedContent</p></li>
			</ul>
		</li>
		<li><p>Features:</p>
			<ul>
				<li><p>- added start/end date</p></li>
				<li><p>- removed timepicker; replaced by a simple dropdown</p></li>
				<li><p>- compatibility with {content_image}</p></li>
			</ul>
		</li>
	</ul>
	<li><p><strong>0.3.2 (June 2010):</strong></p>
		<ul>
			<li><p>- fixed bug where changing back to default content type or changing template caused fatal errors</p></li>
			<li><p>- fixed a bug with smarty processing when saving a page</p></li>
			<li><p>- fixed a bug with preview tab</p></li>
			<li><p>- re-added expand/collapse button to toggle content blocks in backend</p></li>
			<li><p>- added params editor_groups/editor_users to specify certain users/groups that are allowed to edit certain blocks</p></li>
			<li><p>- removed params selected/checked; use param default instead</p></li>
			<li><p>- block ids will be converted from block name using core function munge_string_to_url (to remove special chars, whitespaces, umlauts etc.)</p></li>
			<li><p>- fixed bug of blocktype dropdown/select_multiple where first item had an empty label if only the param &quot;values&quot; is used</p></li>
			<li><p>- added some template vars of the frontend to be also accessible in backend (e.g.: $page_alias)</p></li>
			<li><p>- added param &quot;allow_none&quot; to all content block types to specify if the predefined default value will be used if no value is entered</p></li>
			<li><p>- fixed bug where empty values were never be stored</p></li>
			<li><p>- fixed bug where default value in frontend was ignored if the &quot;allow_none&quot; param was changed after an empty value has been stored</p></li>
			<li><p>- added param &quot;sortable_items&quot; to create a sortable multiple select list (select list will result in a table with checkboxes; only order of selected items will be stored and showed at the top of the list; unselected items will be appended in that order they are placed in the template)</p></li>
		</ul>
	</li>
	<li><p><strong>0.3.1 (May 2010):</strong></p>
		<ul>
			<li><p>- removed the reordering stuff for now (causes trouble at this time)</p></li>
			<li><p>- removed the db stuff (params of content blocks that are defined in template won&#039;t be saved in module db table anymore -> hopefully speed up loading time)</p></li>
			<li><p>- fixed a bug with duplicate content blocks</p></li>
		</ul>
	</li>
	<li>
		<p><strong>AdvancedContent 0.3 (May 2010):</strong></p>
		<ul>
			<li><p>- rewrite code</p></li>
			<li><p>- bugfixes</p></li>
			<li><p>- renamed to AdvancedContent</p></li>
			<li><p>- using separate module template now to dsplay content blocks</p></li>
			<li><p>- removed page alias inheritance</p></li>
		</ul>
	</li>
</ul>
<ul>
	<li><p><strong>XContent BETA 3 (April 2010 - discontinued):</strong></p>
		<ul>
			<li><p>- Major Bugfix (missing &quot;;&quot; and strange invisible invalid chars)</p></li>
		</ul>
	</li>
	<li><p><strong>XContent BETA 2 (April 2010 - discontinued):</strong></p>
		<ul>
			<li><p>- fixed a bug with param &quot;delimiter&quot;</p></li>
			<li><p>- fixed a bug with smarty processing</p></li>
			<li><p>- added inheritance of &quot;Show login form&quot;</p></li>
			<li><p>- added inheritance of page alias to add it as preffix; so if you have a page called &quot;members&quot; and select for each child page &quot;inherit page alias&quot; all child pages aliases will start with &quot;members_&quot;; makes filtering of menu entries with MenuManager param &quot;excludepreffix&quot; or &quot;includepreffix&quot; easier.</p></li>
			<li><p>- minor bugfixes</p></li> 
		</ul>
	</li>
	<li>
		<p><strong>XContent BETA (April 2010):</strong> initial release</p>
		<ul>
			<li><p>- converted the single file into a module</p></li>
			<li><p>- renamed params; see module help for more details</p></li>
		</ul>
	</li>
</ul>
<p><strong>Single file releases (discontinued)</strong>...</p>
<ul>
	<li>
		<p><strong>1.4 (March 2010):</strong></p>
		<ul>
			<li><p>- cleanup code - (NaN)</p></li>
			<li><p>- minor bugfixes - (NaN)</p></li>
			<li><p>- added redirect page if feu is not logged in - (NaN)</p></li>
			<li><p>- added inheritance of feu_access and redirect_page - (NaN)</p></li>
			<li><p>- added param feu_access - (NaN)</p></li>
			<li><p>- added param feu_action - (NaN)</p></li>
			<li><p>- added param redirect_page - (NaN)</p></li>
			<li><p>- added param block_only - (NaN)</p></li>
			<li><p>- added smarty logic in backend - (JeremyBass)</p></li>
			<li><p>- added param style - (JeremyBass)</p></li>
			<li><p>- added param filter (filtering images in backend) - (JeremyBass)</p></li>
			<li><p>- added param ImgMode (dropdown or ImageManager) - (JeremyBass)</p></li>
			<li><p>- added param smartyOn (for processing smarty vars of the tempate in backend) - (JeremyBass)</p></li>
		</ul>
	</li>
	<li><p><strong>1.3 (April 2009):</strong></p>
		<ul>
			<li><p>- CMSms 1.6.* ready - (NaN)</p></li>
			<li><p>- added feu access option - (NaN)</p></li>
		</ul>
	</li>
	<li>
		<p><strong>1.2 (March 2009):</strong> initial release</p>
		<ul>
			<li><p>- A single file Content2.inc.php that needs to be paced in lib/classes/contenttypes.</p></li>
			<li><p>- layout/options of backend panel can be controled by additional smarty params in the template; integrated the {content_image} tag - (mod by NaN)</p></li>
		</ul>
	</li>
</ul>
<br />';
$lang['qca'] = 'P0-705259634-1290412327835';
$lang['utmz'] = '156861353.1296028295.10.11.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=cms made simple';
$lang['utma'] = '156861353.938744718.1290412328.1296030385.1296034084.12';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353';
?>