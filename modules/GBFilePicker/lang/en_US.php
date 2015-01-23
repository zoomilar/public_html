<?php

$lang['GBFilePicker'] = "GBFilePicker";
$lang['installed'] = "Module GBFilePicker %s installed";
$lang['uninstalled'] = "Module GBFilePicker %s uninstalled";
$lang['upgraded'] = "Module GBFilePicker upgraded to %s";
$lang['post_install'] = "Module GBFilePicker %s installed.";
$lang['post_uninstall'] = "Module GBFilePicker %s uninstalled.";
$lang['confirm_uninstall'] = "Do you really want uninstall the GBFilePicker module?";
$lang['currentdir'] = "Current directory";
$lang['image_size'] = "Imagesize";
$lang['file_size'] = "Filesize";
$lang['none'] = "none";
$lang['prefs_updated'] = "Preferences updated";
$lang['fileoperations'] = "File operations";
$lang['toggle_fileoperations'] = "Toggle file operations";
$lang['fileupload'] = "Upload a new file";
$lang['create_dir'] = "Create a new directory";
$lang['upload'] = "Upload";
$lang['create'] = "Create";
$lang['success'] = "Ok";
$lang['error'] = "Error";
$lang['file_uploaded'] = "File '%s' uploaded";
$lang['no_dirname'] = "No dirname provided";
$lang['dir_exists'] = "Dirname '%s' already exists";
$lang['dir_created'] = "New dir '%s' successfully created";
$lang['create_dir_failed'] = "An error occured trying to create dir '%s'";
$lang['no_file_uploaded'] = "No file was uploaded";
$lang['file_too_big'] = "Uploaded file '%s' is too big";
$lang['contains_illegalchars'] = "Filename '%s' contains one or more illegal characters (',\",+,*,\\,/,&,$)";
$lang['upload_failed'] = "Error moving uploaded file '%s' into place";
$lang['confirm_delete_file'] = "Are you sure to delete this file: %s ?";
$lang['file_deleted'] = "File '%s' was successfully deleted";
$lang['delete_file_failed'] = "File '%s' could not be deleted";
$lang['delete_dir_failed'] = "Dir '%s' could not be deleted";
$lang['dir_deleted'] = "Dir '%s' was successfully deleted";
$lang['confirm_delete_dir'] = "Are you sure to delete this directory: %s ?";
$lang['delete_dir'] = "Delete empty subdir";
$lang['delete_file'] = "Delete File";
$lang['delete'] = "Delete";
$lang['restrict_users_diraccess'] = "Restrict user's dir access";
$lang['show_filemanagement'] = "Show filemanagement options";
$lang['allow_scaling'] = "Allow resizing of uploaded images";
$lang['scaling_width'] = "Scaling width";
$lang['scaling_height'] = "Scaling height";
$lang['default_imagesize'] = "Default image size";
$lang['show_thumbfiles'] = "Show thumbnail files as regular files";
$lang['scaling_height'] = "Scaling height";
$lang['create_thumbs'] = "Create thumbnails";
$lang['resize_image'] = "Resize image";
$lang['keep_aspectratio'] = "Keep aspect ratio";
$lang['allow_upscaling'] = "Allow upscaling";
$lang['force_upscaling'] = "Force upscaling";
$lang['decimal_delimiter'] = ".";
$lang['thousand_delimiter'] = ",";
$lang['thumb_prefix_replacement'] = "Thumbnail prefix replacement";
$lang['thumb_upload_action'] = "Rename filenames of uploaded files that start with thumbnail prefix (thumb_)?";
$lang['dir_notfound'] = "Directory '%s' not found!";
$lang['browse_image'] = "Browse images";
$lang['browse_file'] = "Browse files";
$lang['use_mimetype'] = "Use mime-type to get file type";
$lang['no_mimetype'] = "No mime-type function available or not configured properly. This feature is disabled.";
$lang['no_imagefile'] = "'%s' is not an image file";
$lang['filetype_notallowed'] = "Filetype '%s' is not allowed";
$lang['imagedropdown_example'] = "Imagedropdown (showing image files in '%s' using dir='images')";
$lang['imagebrowser_example'] = "Imagebrowser (showing image files in '%s' using dir='images' and mode='browser')";
$lang['filedropdown_example'] = "Filedropdown (showing files in '%s' using type='file')";
$lang['filebrowser_example'] = "Filebrowser (showing files in '%s' using type='file' and mode='browser)'";
$lang['dir_empty'] = "This directory is empty";
$lang['startdir'] = "Go to start dir";
$lang['browser_title'] = "Filebrowser";
$lang['admindescription'] = "A simple filepicker tool to create an input that allows to select files from a given dir using a dropdown or a filebrowser.";
$lang['reload_dir'] = "Reload directory";
$lang['clear_cache'] = "Clear cache";
$lang['reload_dropdown'] = "Update dropdown";
$lang['close'] = "Close";
$lang['demo'] = "Demo";
$lang['feu_access'] = "Frontenduser groups that may use the filepicker in frontend.";
$lang['settings'] = "File browser settings";
$lang['force_scaling'] = "Force scaling";
$lang['default_admin_theme'] = "Default Admin Theme";
$lang['default_frontend_theme'] = "Default Frontend Theme";
$lang['prefs'] = "Preferences";
$lang['help'] = <<<EOT
<br />
<h3>What does this do?</h3>
<p>This provides a filepicker to module developers as well as webdesigners.</p>
<h3>How is it used?</h3>
<p>After installation the module settings can be found in "Extensions->GBFilePicker".</p>
<p><strong>For developers:</strong></p>
<p>Actually at the moment there is just one function that might be of interest for module developers: </p>
<p><code>CreateFilePickerInput(&\$module, \$id, \$name, \$value = '', \$params = array())</code></p>
<p>Here is an example how to integrate the filepicker input in other modules:</p>
<pre><code>if(\$gbfp =& \$this->GetModuleInstance('GBFilePicker')) {

	// prints out a file dropdown showing only images in "[your uploads dir]/images";
	// selected images will appear as thumbnail preview below the dropdown
	
	echo \$gbfp->CreateFilePickerInput('', \$id,'filepicker_input_1','',array('dir'=>'images'));
	
	
	// prints out a button and a hidden input field to browse images in "[your uploads dir]/images" using the built in filebrowser
	// selected images will appear as thumbnail preview below the button;
	// value is stored in the hidden input field
	
	echo \$gbfp->CreateFilePickerInput('', \$id, 'filepicker_input_2', '', array('dir'=>'images','mode'=>'browser'));
	
	
	// prints out a file dropdown showing all files in uploads dir
	echo \$gbfp->CreateFilePickerInput('', \$id, 'filepicker_input_3', '', array('media_type'=>'file'));
	
	
	// prints out a button and a text input field to browse images in uploads/images using the built in filebrowser
	// value is stored in the text input field
	
	echo \$gbfp->CreateFilePickerInput('',\$id, 'filepicker_input_4','',array('media_type'=>'file','mode'=>'browser'));
	
}</code></pre>
<p><a href="../modules/GBFilePicker/doc/api/index.html" target="_blank">Click here to view the generated API documentation for more details.</a></p>
<p><strong>For designers:</strong></p>
<p>You can use this module in conjunction with the {content_module} tag of the CMSms core.<br />
Just place this in your template to get an additional content block that shows a filepicker in backend when editing the page:</p>
<pre><code>{content_module block="filepicker_block" module="GBFilePicker"}</code></pre>
<h3>What parameters are available?</h3>
<p>All params are optional and can be used with {content_module} tag as well with the api function. <br />
Notice that some params will have no effect if you are the admin. That means the admin has always any permissions.<br />E.g: you cannot deny filemanagement or image resizing on upload to the admin but only to other users.</p>
<ul>
	<li>
		<tt>media_type</tt> <em>(file,image)</em>
		<ul>
			<li>Allows you to specify what media type is displayed. (supports only images and all files at the moment)</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>mode</tt> (browser/dropdown)
		<ul>
			<li>
				By default a dropdown will be used. Set to "browser" if user may browse the files.<br />
				<code>{content_module module="GBFilePicker" block="some_image" mode="browser"}</code>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>dir</tt> (string)
		<ul>
			<li>
				The name of a directory (relative to the uploads directory from which to select images/files. If not specified, the uploads directory will be used.<br />
				E.g.: This will display the dir "[your uploads dir]/images/".<br />
				<code>{content_module module="GBFilePicker" block="some_image" dir="images"}</code>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>show_subdirs</tt> (true/false)
		<ul>
			<li>
				Set to true if user may browse subdirectories. (mode="browser" only)<br />
				E.g.: <code>{content_module module="GBFilePicker" block="some_file" media_type="file" show_subdirs="true"}</code><br />
				<em><strong>Note:</strong> This param will be ignored if the user belongs to the admin group.<br /></em>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>upload</tt> (true/false)
		<ul>
			<li>
				Set to true if user may upload files.<br />
				Set to false to deny upload.<br />
				<em><strong>Note:</strong> By default this param depends on the user permission "Modify Files".<br />
				If set to true you can grant upload of files to certain blocks even to users without apropriate permission.<br />
				Vise versa you can deny file upload even to users with "Modify Files" permission.<br />
				This only works if the module setting "Show filemanagement options" is set.<br /></em>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>delete</tt> (true/false)
		<ul>
			<li>
				Set to true if user may delete files.<br />
				Set to false to deny deleting files.<br />
				<em><strong>Note:</strong> By default this param depends on the user permission "Modify Files".<br />
				If set to true you can grant deleting files or directories to certain blocks even to users without apropriate permission.<br />
				Vise versa you can deny deleting anything even to users with "Modify Files" permission.<br />
				This only works if the module setting "Show filemanagement options" is set.<br /></em>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>create_dirs</tt> (true/false)
		<ul>
			<li>
				Set to true if users may create directories.<br />
				Set to false to deny directory creation.<br />
				<em><strong>Note:</strong> By default this param depends on the user permission "Modify Files".<br />
				If set to true you can grant creation of directories to certain blocks even to users without apropriate permission.<br />
				Vise versa you can deny directory creation even to users with "Modify Files" permission.<br />
				This only works if the module setting "Show filemanagement options" is set.<br />
				If you want to allow to create directories to non-admin users you need to set show_subdirs=true.</em>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>lock_input</tt> (true/false)
		<ul>
			<li>
				Set to false if user may enter the file path in the file input (block_type="file" only)<br />
				By default this is always true if the user is no admin.
				<em><strong>Note:</strong> This param will be ignored if the user belongs to the admin group.<br /></em>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>exclude_prefix</tt> (string)
		<ul>
			<li>
				A comma separated list of prefixes to exclude files that starts with the set prefix.<br/>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>include_prefix</tt> (string)
		<ul>
			<li>
				A comma separated list of prefixes to show only files that starts with the set prefix.<br/>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>exclude_sufix</tt> (string)
		<ul>
			<li>
				A comma separated list of sufixes to exclude files that ends with the set sufix.<br/>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>include_sufix</tt> (string)
		<ul>
			<li>
				A comma separated list of sufixes to show only files that ends with the set sufix.<br/>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>file_extensions</tt> (string)
		<ul>
			<li>A comma separated list of allowed file extensions of files to display (excluding the dot)</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>restrict_users_diraccess</tt> (true/false)
		<ul>
			<li>Usually this is a preference that can be set up in the modules admin panel. It grants access only to a directory that is named like the username.<br />
				Let's assume the username is Foo. So the module looks for a dir in "[your uploads dir]/Foo/".<br />
				If it does not exist it will be created. If set to true everything will be relative to the username dir. <br />
				That means this example will look for images in "[your uploads dir]/Foo/images/":<br />
				<code>{content_module module="GBFilePicker" block="some_image" dir="images" restrict_users_diraccess=true}</code><br />
				With this param you can override this setting to specify certain preferences for each block individually.<br />
				<em><strong>Note:</strong> This has no effect if you are admin.</em>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>allow_none</tt> (true/false)
		<ul>
			<li>
				This is for mode dropdown only. If set to false there is no "none" option in the dropdown.<br />
				<em><strong>Note:</strong> This has no effect if you are admin.</em>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>allow_scaling</tt> (true/false)
		<ul>
			<li>Usually this is a preference that can be set up in the modules admin panel. It specifies if images may be resized on upload.<br />
				With this param you can override this setting to specify certain preferences for each block individually.<br />
				<em><strong>Note:</strong> This has no effect if you are admin.</em>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>force_scaling</tt> (true/false)
		<ul>
			<li>Usually this is a preference that can be set up in the modules admin panel. <br />
				If set images will be resized to a given size if user may not resize images.<br />
				With this param you can override this setting to specify certain preferences for each block individually.<br />
				<em><strong>Note:</strong> This has no effect if you are admin.</em>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>scaling_width</tt> (int)
		<ul>
			<li>Usually this is a preference that can be set up in the modules admin panel. It specifies the default image width to resize an image to on upload.<br />
				With this param you can override this setting to specify certain preferences for each block individually.
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>scaling_height</tt> (int)
		<ul>
			<li>Usually this is a preference that can be set up in the modules admin panel. It specifies the default image height to resize an image to on upload.<br />
				With this param you can override this setting to specify certain preferences for each block individually.
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>allow_upscaling</tt> (true/false)
		<ul>
			<li>Usually this is a preference that can be set up in the modules admin panel. It specifies if images may be enlarged when resized.<br />
				With this param you can override this setting to specify certain preferences for each block individually.<br />
				<em><strong>Note:</strong> This has no effect if you are admin.</em>
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>create_thumbs</tt> (true/false)
		<ul>
			<li>Usually this is a preference that can be set up in the modules admin panel. It specifies if the module will create thumbnails of images when reading the directory.<br />
				With this param you can override this setting to turn off thumbail creation for a certain input block individually.
			</li>
		</ul>
		<br />
	</li>
	<li>
		<tt>show_thumbfiles</tt> (true/false)
		<ul>
			<li>Usually this is a preference that can be set up in the modules admin panel. It specifies if the module will show even the thumbnails as regular files.<br />
				With this param you can override this setting to specify certain preferences for each block individually.
			</li>
		</ul>
		<br />
	</li>
</ul>
<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
	<li>The projects homepage is <a href="http://dev.cmsmadesimple.org/projects/gbfilepicker/">http://dev.cmsmadesimple.org/projects/gbfilepicker/</a></li>
	<li>Additional discussion of this module may also be found in the CMS Made Simple Forums:<br />
	<a href="http://forum.cmsmadesimple.de">http://forum.cmsmadesimple.de</a><br />
	<a href="http://forum.cmsmadesimple.org">http://forum.cmsmadesimple.org</a></li>
</ul>
<br />
<p>Please report any kind of feedback.</p>
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
<p>Copyright &copy; 2010-2012, Georg Busch (NaN). All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>
<br />
EOT;
$lang['changelog'] = <<<EOT
<br />
<ul>
	<li><p><strong>GBFilePicker 1.3.3 (Sep 2012):</strong></p>
		<ul>
			<li><p><strong>Bugfixes:</strong></p>
				<ul>
					<li><p>#7746: option to rename files that start with thumbnail prefix on upload</p></li>
					<li><p>#7954: error moving uploaded file into place</p></li>
					<li><p>compatibility bugfixes for CMSms 1.11</p></li>
				</ul>
				<br />
			</li>
		</ul>
		<br />
	</li>
	<li><p><strong>GBFilePicker 1.3.2 (Mar 2012):</strong></p>
		<ul>
			<li><p><strong>Bugfixes:</strong></p>
				<ul>
					<li><p>#7575: (skip thumbnail creation if image is too big for memory)</p></li>
					<li><p>fixed an issue with the template path</p></li>
				</ul>
				<br />
			</li>
		</ul>
		<br />
	</li>
	<li><p><strong>GBFilePicker 1.3.1 (Nov 2011):</strong></p>
		<ul>
			<li><p><strong>Bugfixes:</strong></p>
				<ul>
					<li><p>#6260: various errors in IE 7 + 8</p></li>
					<li><p>fixed error with directories and files without sufficient permission to read them via php script</p></li>
					<li><p>#7203: Problems uploading files using CMSms 1.10.x</p></li>
					<li><p>#7161: Filepicker won't open, if subdirectory contains a trailing dot in filename</p></li>
				</ul>
				<br />
			</li>
			<li><p><strong>Features:</strong></p>
				<ul>
					<li><p>added compatibility to news module (needs extra plugin and module_custom)</p></li>
				</ul>
				<br />
			</li>
			<li><p><strong>Known issues:</strong></p>
				<ul>
					<li><p>IE 6 is unsupported</p></li>
					<li><p>IE 9 will give some js warnings but should work</p></li>
				</ul>
				<br />
			</li>
		</ul>
		<br />
	</li>
	<li><p><strong>GBFilePicker 1.2.9 / 1.3 (March 2011):</strong></p>
		<ul>
			<li><p><strong>Bugfixes:</strong></p>
				<ul>
					<li><p>fixed E_DEPRECATED error message</p></li>
					<li><p>fixed error with param filebrowser_template</p></li>
					<li><p>fixed issue with transparent gif/png images on resize and thumbnail creation</p></li>
				</ul>
				<br />
			</li>
			<li><p><strong>Features:</strong></p>
				<ul>
					<li><p>added param smarty to process param values by plugins, udts or modules</p></li>
					<li><p>added themes</p></li>
				</ul>
				<br />
			</li>
		</ul>
		<br />
	</li>
	<li><p><strong>GBFilePicker 1.2 (November 2010):</strong></p>
		<ul>
			<li><p><strong>Bugfixes:</strong></p>
				<ul>
					<li><p>fixed error with thumbnail aspectratio after image has been selected</p></li>
					<li><p>fixed error with dir parameter</p></li>
					<li><p>fixed layout issue with transparent elements in IE (thanks to george_gr)</p></li>
				</ul>
				<br />
			</li>
			<li><p><strong>Features:</strong></p>
				<ul>
					<li><p>fileoperations can now be disabled to non-admin users in general (regardless of their permissions)</p></li>
					<li><p>better thumbnail handling (thumbs are stored in /tmp/cache/GBFilePickerThumbs/)</p></li>
					<li><p>added param force_scaling</p></li>
					<li><p>params upload, delete, create_dirs, show_subdirs can now also set to false to deny functions even to users with sufiecient permission (except the admins)</p></li>
				</ul>
				<br />
			</li>
		</ul>
		<br />
	</li>
	<li><p><strong>GBFilePicker 1.1 (October 2010):</strong></p>
		<ul>
			<li><p>bugfixes</p></li>
			<li><p>rewrite code; notice the api changes</p></li>
		</ul>
	</li>
	<li>
		<p><strong>GBFilePicker 1.0 (September 2010):</strong></p>
		<p>initial release</p>
	</li>
</ul>
<br />
EOT;
?>
