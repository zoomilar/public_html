<?php

$lang['friendlyname'] = 'Extended Content Blocks';
$lang['postinstall'] = 'Extended Content Blocks was successful installed';
$lang['postuninstall'] = 'Extended Content Blocks was successful uninstalled';
$lang['really_uninstall'] = 'Really? Are you sure
you want to unsinstall this fine module?';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['upgraded'] = 'Module upgraded to version %s.';
$lang['admindescription'] = 'This module adds new content  blocks to your CMS Made Simple';


$lang['selected'] = 'Selected';
$lang['select'] = 'Select';
$lang['refresh'] = 'Refresh';

$lang['help'] = '

<h3>What Does This Do?</h3>
<p>Module adds aditional content blocks for CMS Made Simple.</p>
<h3>Fields</h3>
<p><strong>file_selector</strong></p>
<p>Example:  {content_module module="ECB" field="file_selector" block="test10" dir="images" filetypes="jpg,gif,png" excludeprefix="thumb_"}        </p>
<p>Parameters</p>
<p>
filetypes - comma separated<br /> 
dir (optional) - default uploads/<br />
excludeprefix (optional)<br />
recurse (optional)<br />
sortfiles (optional)
preview (optional) - only for images
</p>
<p><strong>color_picker</strong></p>
<p>Example:  {content_module module="ECB" field="color_picker" block="test1" label="Color" default_value="#000000"}</p>
<p>Parameters</p>
<p>
default_value (optional)<br />
size (optional) - default 10
</p>
<p><strong>DEPRECATED: dropdown_from_module</strong> (use dropdown_from_udt)</p>
<p><strong>dropdown_from_udt</strong></p>
<p>Example: {content_module module="ECB" field="dropdown_from_udt" block="test2" label="Gallery" udt="mycustomudt"  first_value="=select="}</p>
<p>Ouput from UDT must be array() - example: array("label"=>"value", "label 2 "=>"value 2")</p>
<p>Parameters</p>
<p>
udt (required) - udt name<br />
first_value (optional) <br />
multiple (optional) - add multiple option select support<br />
size (optional) - multiple enabled only
</p>
<p><strong>dropdown</strong></p>
<p>Example: {content_module module="ECB" field="dropdown" block="test5" label="Fruit"  values="Apple=apple,Orange=orange" first_value="select fruit"}</p>
<p>Parameters</p>
<p>
values (required) - comma separated. Example: Apple=apple,Orange=orange,Green=green <br />
first_value (optional)<br />
multiple (optional) - add multiple option select support<br />
size (optional) - multiple enabled only
</p>
<p><strong>checkbox</strong></p>
<p>Example: {content_module module="ECB" field="checkbox" block="test11" label="Checkbox"  default_value="1"}</p>
<p>Parameters</p>
<p>
default_value (optional)
</p>
<p><strong>module_link</strong></p>
<p>Example: {content_module module="ECB" field="module_link" label="Module edit" block="test3"  mod="Cataloger" text="Edit catalog" }</p>
<p>Parameters</p>
<p>
mod (required) <br />
text (required) <br />
target (optional) - default _self
</p>
<p><strong>link</strong></p>
<p>Example: {content_module module="ECB" field="link" label="Search" block="test4" target="_blank" link="http://www.bing.com" text="bing search"}</p>
<p>Parameters</p>
<p>
link (required) <br />
text (required) <br />
target (optional) - default _self
</p>
<p><strong>timepicker</strong></p>
<p>Example: {content_module module="ECB" field="timepicker" label="Time" block="test45"}</p>
<p>Parameters</p>
<p>
size (optional) default 100<br />
time_format (optional) default HH::ss<br />
max_length (optional) default 10 <br />
</p>
<p><strong>datepicker</strong></p>
<p>Example: {content_module module="ECB" field="datepicker" label="Date" block="test44"}</p>
<p>Parameters</p>
<p>
size (optional) default 100<br />
date_format (optional) default yy-mm-dd<br />
time (optional) - add time picker default 0<br />
time_format (optional) default HH::ss<br />
max_length (optional) default 10 <br />
</p>
<p><strong>input</strong></p>
<p>Example: {content_module module="ECB" field="input" label="Text" block="test5" size=55 max_length=55 default_value="fill it"}</p>
<p>Parameters</p>
<p>
size (optional) default 30<br />
max_length (optional) default 255 <br />
default_value (optional) - default value for input
</p>
<p><strong>textarea</strong></p>
<p>Example: {content_module module="ECB" field="textarea" label="Textarea" block="test6" rows=10 cols=40 default_value="fill it"}</p>
<p>Parameters</p>
<p>
rows (optional) default 20<br />
cols (optional) default 80 <br />
default_value (optional) - default value for textarea
</p>
<p><strong>editor (textarea with wysiwyg)</strong></p>
<p>Example: {content_module module="ECB" field="editor" label="Textarea" block="test7" rows=10 cols=40 default_value="fill it"}</p>
<p>Parameters</p>
<p>
rows (optional) default 20<br />
cols (optional) default 80 <br />
default_value (optional) - default value for textarea
</p>
<p><strong>text </strong></p>
<p>Example: {content_module module="ECB" field="text" label="Text" block="test8" text="Hello word!"}</p>
<p>Parameters</p>
<p>
text (required) text in admin (add information for users, ProcessTemplateFromData)<br />
</p>
<p><strong>pages </strong></p>
<p>Example: {content_module module="ECB" field="pages" label="Page" block="test10"}</p>
<p><strong>hr (horizontal line)</strong></p>
<p>Example: {content_module module="ECB" field="hr" label="Other blocks" block="blockname"}</p>

<h3>Do you like my work? </h3>
<p><a href="http://cmsmadesimple.sk/donate-card/?utm_source=cmsmadesimple&utm_medium=link&utm_campaign=help&utm_content=ecb" target="_blank">Give me five or feel free to <strong>donate</strong> me</a></p>


   
';
?>
