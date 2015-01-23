<?php
#-------------------------------------------------------------------------------
#
# Module : GBFilePicker (c) 2010-2012 by Georg Busch (georg.busch@gmx.net) 
#          a file picker tool for CMS Made Simple
#          The projects homepage is: dev.cmsmadesimple.org/projects/gbfilepicker
#          CMS Made Simple is (c) 2004-2012 by Ted Kulp
#          The projects homepage is: cmsmadesimple.org
# Version: 1.3.3
# File   : action.filePicker.php
#          This file is a modification of the TinyMCE filepicker that comes by
#          default with CMSms
# Purpose: browse through a given directory
# License: GPL
#
#-------------------------------------------------------------------------------

if(!function_exists('cmsms') || !is_object(cmsms())) exit;

global $CMS_ADMIN_PAGE;
$config = cmsms()->GetConfig();
$smarty = cmsms()->GetSmarty();

//input name
if(!isset($params['name']) || $params['name']=='')
{
	return;
}
else
{
	$name = htmlentities(trim($params['name']));
}
if($id == 'cntnt01' && isset($_SESSION['GBFP_id_'.$name]))
{
	$id = $_SESSION['GBFP_id_'.$name];
}

if(!$session_params =& $this->GetInputParams($id,$name))
{
	return;
}

$params = array_merge($params, $session_params);

if($params['name'] != $name)
{
	return;
}

// check permission
if(isset($CMS_ADMIN_PAGE) && $CMS_ADMIN_PAGE == 1)
{
	check_login();
	if(!$this->CheckPermission('Use GBFilePicker'))
		return;
	$username = $this->_username;
}
else
{
	if( !$feusers =& $this->GetModuleInstance('FrontEndUsers' ) )
	{
		return;
	}
	if(!$userid = $feusers->LoggedInId())
	{
		return;
	}
	if(!$groups = $feusers->GetMemberGroupsArray($userid))
	{
		return;
	}
	$access = false;
	foreach($groups as $_group)
	{
		if(in_array($_group['groupid'],$params['feu_access']))
		{
			$access = true;
			break;
		}
	}
	if(!$access)
	{
		return;
	}
	$username = $feusers->GetUserName($userid);
}

// module id
$_id = $id;
if($params['id'] == '')
{
	$_id = '';
}

// dir stuff
$current_dir = $config['uploads_path'] . DIRECTORY_SEPARATOR;
$current_url  = $config['uploads_url'] . '/';

if($params['start_dir'] != '' && !$this->_isAdmin)
{
	$current_dir .= str_replace('/', DIRECTORY_SEPARATOR, $params['start_dir']) . DIRECTORY_SEPARATOR;
	$current_url .= $params['start_dir'] . '/';
}

$dir = '';
if(isset($params['dir']) && $params['show_subdirs'])
{
	$dir = $this->CleanUrl($params['dir'], false);
	$current_dir .= str_replace('/', DIRECTORY_SEPARATOR, $dir) . DIRECTORY_SEPARATOR;
	$current_url .= $dir . '/';
}

$usefm = (($params['upload'] || $params['delete'] || $params['create_dirs']) && ($this->GetPreference('show_filemanagement') || $this->_isAdmin));

// go...
if(file_exists($current_dir))
{
	// ToTo: move the file management stuff into a separat action/class/method
	//Handle File upload and dir creation
	if ($usefm)
	{
		if (isset($params['upload_file']) && $params['upload'])
		{
			if (isset($_FILES[$id.'newfile']))
			{
				//CHeck for uploaded file
				if ($_FILES[$id.'newfile']['name'] != '')
				{
					// get file type
					$filetype = $this->GetFileType($_FILES[$id.'newfile']['tmp_name'],$this->GetPreference('use_mimetype',false));
					if(!$filetype || $filetype == 'tmp') {
						if($this->GetPreference('use_mimetype',false))
						{
							$filetype = $_FILES[$id.'newfile']['file_type'];
						}
						else
						{
							$filetype = $this->GetFileType($_FILES[$id.'newfile']['name']);
						}
					}
					
					//check filename
					if ($this->ContainsIllegalChars($_FILES[$id.'newfile']['name']))
					{
						$errormessage = $this->Lang('contains_illegalchars', $_FILES[$id.'newfile']['name']);
					}
					else if (($_FILES[$id.'newfile']['size']>$config['max_upload_size'])
						|| ($_FILES[$id.'newfile']['error'] == 1))
					{
						$errormessage = $this->Lang('file_too_big', $_FILES[$id.'newfile']['name']);
					}
					else if($params['media_type'] == 'image' && !in_array(str_replace('image/','',$filetype),$params['file_extensions']))
					{
						$errormessage = $this->Lang('no_imagefile',$_FILES[$id.'newfile']['name'] . ' ('.$filetype.')');
					}
					else if($params['media_type'] != 'image' && !empty($params['file_extensions']) && !in_array(strtolower(substr($_FILES[$id.'newfile']['name'], strrpos($_FILES[$id.'newfile']['name'], '.') + 1)),$params['file_extensions']))
					{
						$errormessage = $this->Lang('filetype_notallowed', $filetype);
					}
					else
					{
						$filename = $this->CleanPath($_FILES[$id.'newfile']['name'], false);
						if(startswith($filename, 'thumb_') && $this->GetPreference('thumb_upload_action'))
						{
							$filename = $this->GetPreference('thumb_prefix_replacement') . substr($filename, strlen('thumb_'));
						}
						$filename = $current_dir.$filename;
						
						$resize = $params['force_scaling'];
						if (isset($params['resize_on']))
						{
							$resize = $params['resize_on'];
						}
						if ($resize)
						{
							$width = $params['scaling_width'];
							if(isset($params['resize_x']))
							{
								$width = $params['resize_x'];
							}
							$height = $params['scaling_height'];
							if(isset($params['resize_y']))
							{
								$height = $params['resize_y'];
							}
							$keep_aspectratio = $params['keep_aspect_ratio'];
							if(isset($params['keep_aspectratio']))
							{
								$keep_aspectratio = $params['keep_aspectratio'];
							}
							if ($this->HandleFileResizing($_FILES[$id.'newfile']['tmp_name'], $filename, $width, $height, $keep_aspectratio, ($params['allow_upscaling'] && $params['force_upscaling']), 100, false))
							{
								if ($params['create_thumbs'])
								{
									$this->CreateThumbnail($filename);
									#$thumbname = $current_dir."thumb_".$this->CleanPath($_FILES[$id.'newfile']['name'], false);
									#$this->HandleFileResizing($filename,$thumbname,get_site_preference('thumbnail_width',96),get_site_preference('thumbnail_height',96),true,false,60,false);
								}
								$message = $this->Lang('file_uploaded', $_FILES[$id.'newfile']['name']);
								$value = $this->CleanPath($dir.'/'.$_FILES[$id.'newfile']['name'],false);
							}
							else
							{
								$errormessage = $this->Lang('upload_failed', $_FILES[$id.'newfile']['name']);
							}
						}
						else
						{
							if (cms_move_uploaded_file($_FILES[$id.'newfile']['tmp_name'], $filename))
							{
								if ($params['create_thumbs'])
								{
									$this->CreateThumbnail($filename);
									#$thumbname = $current_dir."thumb_".$this->CleanPath($_FILES[$id.'newfile']['name'],false);
									#$this->HandleFileResizing($filename,$thumbname,get_site_preference('thumbnail_width',96),get_site_preference('thumbnail_height',96),true,false,60,false);
								}
								$message = $this->Lang('file_uploaded',$_FILES[$id.'newfile']['name']);
								$value = $this->CleanPath($dir.'/'.$_FILES[$id.'newfile']['name'],false);
							}
							else
							{
								$errormessage = $this->Lang('upload_failed',$_FILES[$id.'newfile']['name']);
							}
						}
					}
				}
				else
				{
					$errormessage = $this->Lang('no_file_uploaded');
				}
			}
			else
			{
				//This shouldn't happen
				$errormessage = $this->Lang('no_file_uploaded');
			}
		}
		
		if (isset($params['create_dir']) && $params['create_dirs'])
		{
			if (isset($params['newdir']) && $params['newdir']!='')
			{
				$new_dir = $this->CleanPath($params['newdir'],false);
				if (!is_dir($current_dir . $new_dir))
				{
					if (@mkdir($current_dir . $new_dir,0755,$this->_isAdmin))
					{
						$message = $this->Lang('dir_created', str_replace($config['root_path'],'', $current_dir . $new_dir));
					}
					else
					{
						$errormessage = $this->Lang('create_dir_failed', str_replace($config['root_path'],'', $current_dir . $new_dir));
					}
				}
				else
				{
					$errormessage = $this->Lang('dir_exists', str_replace($config['root_path'],'', $current_dir . $new_dir));
				}
			}
			else
			{
				$errormessage = $this->Lang('no_dirname');
			}
		}
		if (isset($params['deletefilename']) && $params['delete'])
		{
			$filename = $this->CleanPath(base64_decode($params['deletefilename']),false);
			if (@unlink($current_dir.$filename))
			{
				//@unlink($current_dir.'thumb_'.$filename);
				@unlink(cms_join_path($config['previews_path'] , 'GBFilePickerThumbs' , 'thumb_' . munge_string_to_url(str_replace($config['uploads_path'], '', $current_dir)) . '_' . $filename));
				$message = $this->Lang('file_deleted',str_replace($config['uploads_url'],'',$current_url.$filename));
			}
			else
			{
				$errormessage = $this->Lang('delete_file_failed', str_replace($config['uploads_url'],'',$current_url.$filename));
			}
		}
		if (isset($params['deletesubdir']) && $params['delete'])
		{
			$filename = $this->CleanPath(base64_decode($params['deletesubdir']),false);
			if (@rmdir($current_dir.$filename))
			{
				$message = $this->Lang('dir_deleted', str_replace($config['uploads_url'],'',$current_url.$filename));
			}
			else
			{
				$errormessage = $this->Lang('delete_dir_failed', str_replace($config['uploads_url'],'',$current_url.$filename));
			}
		}
		//---
	}
	$filecount = 0;
	$dircount = 0;
	
	$files =& $this->GetInputFiles($id,$name,$current_dir, !$params['show_subdirs']);
	if(!count($files) && $dir == '' && !$params['show_subdirs'])
	{
		$errormessage = $this->Lang('dir_empty');
	}
	
	foreach($files as $k=>$file)
	{
		if ($file->is_dir)
		{
			/** @todo: check if this is needed */
			if (!$params['show_subdirs'])
			{
				unset($files[$k]);
				reset($files);
				continue;
			}
			$files[$k]->fileurl = str_replace('&amp;','&',
				$this->CreateLink(
					$id,
					'fileBrowser',
					$returnid,
					'[' . $file->basename . ']',
					array('dir' => $dir . '/' . $file->basename, 'name' => $name),
					'',
					true));
			
			$files[$k]->filelink = str_replace('&amp;','&',
				$this->CreateLink(
					$id,
					'fileBrowser',
					$returnid,
					'[' . $file->basename . ']',
					array('dir' => $dir . '/' . $file->basename, 'name' => $name)));
			
			if ($this->IsDirEmpty($current_dir.$file->basename) && ($usefm && $params['delete']))
			{
				$files[$k]->confirmdelete = $this->lang('confirm_delete_dir',$file->basename);
				$files[$k]->deletelink = str_replace('&amp;','&',
					$this->CreateLink(
						$id,
						'delete',
						$returnid,
						$this->GetActionIcon('delete'),
						array('dir' => $dir, 'name' => $name, 'deletesubdir' => base64_encode($file->basename)),
						$files[$k]->confirmdelete = $this->lang('confirm_delete_dir',$file->basename)));
				
				$files[$k]->deleteurl = str_replace('&amp;','&',
					$this->CreateLink(
						$id,
						'delete',
						$returnid,
						$this->GetActionIcon('delete'),
						array('dir' => $dir, 'name' => $name, 'deletesubdir' => base64_encode($file->basename)),
						'',
						true));
			}
			$dircount++;
		}
		else
		{
			if ($usefm && $params['delete'])
			{
				$files[$k]->filelink = str_replace('&amp;','&',$file->fullurl); // ???
				
				$files[$k]->confirmdelete = $this->lang('confirm_delete_file',$file->basename);
				$files[$k]->deleteurl = str_replace('&amp;','&',
					$this->CreateLink(
						$id,
						'delete',
						$returnid,
						$this->GetActionIcon('delete'),
						array('dir' => $dir, 'name' => $name, 'deletefilename' => base64_encode($file->basename)),
						'',
						true));
				
				$files[$k]->deletelink = str_replace('&amp;','&',
					$this->CreateLink(
						$id,
						'delete',
						$returnid,
						$this->GetActionIcon('delete'),
						array('dir' => $dir, 'name' => $name, 'deletefilename' => base64_encode($file->basename)),
						$files[$k]->confirmdelete));
				
			}
			
			$i    = 0;
			$unit = ' B';
			while($files[$k]->filesize > 1024)
			{
				$i++;
				$files[$k]->filesize = $files[$k]->filesize/1024;
			}
			switch($i)
			{
				case '1': $unit = ' KB'; break;
				case '2': $unit = ' MB'; break;
				case '3': $unit = ' TB'; break;
			}
			$files[$k]->filesize = number_format($files[$k]->filesize, ($i>0?2:0), $this->lang('decimal_delimiter'), $this->lang('thousand_delimiter'));
			$files[$k]->filesize = $files[$k]->filesize . $unit;
			$filecount++;
		}
	}
	
	if (trim($dir, './') != '' && $params['show_subdirs'])
	{
		$parent_dir               = new stdClass();
		$parent_dir->is_dir       = true;
		$parent_dir->fileicon     = $this->GetFileIcon('',true);
		$parent_dir->id           = munge_string_to_url(dirname($dir));
		$parent_dir->relurl       = trim(dirname(str_replace($config['uploads_url'],'',$current_url)),'/');
		$parent_dir->last_modifed = '';
		$parent_dir->filename     = '..';
		$parent_dir->basename     = '..';
		$parent_dir->fileurl     = str_replace('&amp;','&',
			$this->CreateLink(
				$id,
				'fileBrowser',
				$returnid,'[..]',
				array('dir' => dirname($dir), 'name' => $name),
				'',
				true));
		
		$parent_dir->filelink     = str_replace('&amp;','&',
			$this->CreateLink(
				$id,
				'fileBrowser',
				$returnid,'[..]',
				array('dir' => dirname($dir), 'name' => $name)));
		
		array_unshift($files, $parent_dir);
	}
	
	$smarty->assign('gbfp_thumb_width', get_site_preference('thumbnail_width',96));
	$smarty->assign('gbfp_thumb_height', get_site_preference('thumbnail_height','auto'));
	$smarty->assign('gbfp_filesize_text', $this->Lang('file_size'));
	$smarty->assign('gbfp_imagesize_text', $this->Lang('image_size'));
	$smarty->assign_by_ref('gbfp_files', $files);
	
	if($this->_isAdmin || $params['show_subdirs'])
	{
		$_dir = '';
		$breadcrumbs = array();
		foreach($this->CleanArray(explode('/', $dir)) as $k => $v)
		{
			$_dir .= $v;
			if(trim($dir, './') != '' && $_dir != $params['start_dir']) {
				$onedir           = new stdClass();
				$onedir->filename = $v;
				$onedir->id       = munge_string_to_url(trim($_dir,'/ '));
				$onedir->fileurl  = str_replace('&amp;','&',
					$this->CreateLink(
						$id,
						'fileBrowser',
						$returnid,
						$v,
						array('dir' => trim($_dir,'/ '), 'name' => $name),
						'',
						true));
				
				$onedir->filelink = str_replace('&amp;','&',
					$this->CreateLink(
						$id,
						'fileBrowser',
						$returnid,
						$v,
						array('dir' => trim($_dir,'/ '), 'name' => $name)));
				
				$breadcrumbs[]    = $onedir;
			}
			$_dir .= '/';
		}
		$smarty->assign_by_ref('gbfp_breadcrumbs', $breadcrumbs);
		$smarty->assign_by_ref('gbfp_breadcrumbs', $breadcrumbs);
		$start_url = str_replace('&amp;','&',
			$this->CreateLink(
				$id,
				'fileBrowser',
				$returnid,
				$this->lang('startdir'),
				array('dir' => $params['start_dir'], 'name' => $name),
				'',
				true));
		
		$start_link = str_replace('&amp;','&',
			$this->CreateLink(
				$id,
				'fileBrowser',
				$returnid,
				$this->lang('startdir'),
				array('dir' => $params['start_dir'], 'name' => $name)));
		
		$smarty->assign_by_ref('gbfp_startlink',$start_link);
		$smarty->assign_by_ref('gbfp_starturl',$start_url);
		$smarty->assign('gbfp_startdir_text', $this->lang('startdir'));
		$smarty->assign('gbfp_startdir', $params['start_dir']);
	}
	
	// if filemanagement allowed
	if ($usefm && ($params['upload'] || $params['create_dirs']))
	{
		$smarty->assign('gbfp_fileoperations_text', $this->Lang('fileoperations'));
		if(!$userid = get_userid(false))
		{
			$fileoperations_display = 1;
			if(isset($_SESSION['GPFP_fileoperations_display']))
			{
				$fileoperations_display = $_SESSION['GPFP_fileoperations_display'];
			}
		}
		else
		{
			$fileoperations_display = get_preference($userid,'GBFP_fileoperations_display',1);
		}
		$smarty->assign('gbfp_fileoperations_display', $fileoperations_display);
		$smarty->assign('gbfp_prefurl',str_replace('&amp;','&',
			$this->CreateLink($id,
				'savePrefs',
				$returnid,
				$this->lang('toggle_fileoperations'),
				array('toggle'=>'fileoperations', 'display'=>''),
				'',
				true)));
		$smarty->assign('gbfp_preflink',str_replace('&amp;','&',
			$this->CreateLink($id,
				'savePrefs',
				$returnid,
				$this->lang('toggle_fileoperations'),
				array('toggle'=>'fileoperations', 'display'=>''))));
		$smarty->assign('gbfp_toggle_fileoperations_text', $this->lang('toggle_fileoperations'));
		
		$smarty->assign('gbfp_formstart', $this->CreateFormStart($id, 'fileBrowser',
			$returnid, 'post', 'multipart/form-data', false, '',
			array('name'=>$name,'dir'=>$dir)));
		
		$smarty->assign('gbfp_fileupload_text', $this->Lang('fileupload'));
		$smarty->assign('gbfp_fileupload_input', $this->CreateInputFile($id, 'newfile', '', 20));
		
		// ToDo !!!
		$targetid = 'GBFP_content';
		$close_browser = false;
		if($params['mode'] == 'dropdown')
		{
			$close_browser = true;
			$targetid = $_id.$name.'_GBFP_dropdown_wrapper';
		}
		// ---
		$smarty->assign('gbfp_fileupload_submit',$this->CreateInputSubmit($id, 'upload_file', $this->Lang('upload')));
		
		if($params['show_subdirs'] && $params['create_dirs'])
		{
			$smarty->assign('gbfp_createdir_text', $this->Lang('create_dir'));
			$smarty->assign('gbfp_createdir_input', $this->CreateInputText($id, 'newdir', '', 20, 255));
			$smarty->assign('gbfp_createdir_submit', $this->CreateInputSubmit($id, 'create_dir', $this->Lang('create')));
		}
		if ($params['allow_scaling'])
		{
			$smarty->assign('gbfp_allow_upscaling', $params['allow_upscaling']);
			
			$smarty->assign('gbfp_resizeimage_text', $this->Lang('resize_image'));
			$smarty->assign('gbfp_resizeimage_input',
				$this->CreateInputHidden($id,'resize_on',0) .
				$this->CreateInputCheckbox($id, 'resize_on', '1',$params['force_scaling']));
			
			$smarty->assign('gbfp_imagesize_text', $this->Lang('image_size'));
			$smarty->assign('gbfp_imagesize_x_input', $this->CreateInputText($id, 'resize_x', $params['scaling_width'], 4, 4));
			$smarty->assign('gbfp_imagesize_y_input', $this->CreateInputText($id, 'resize_y', $params['scaling_height'], 4, 4));
			
			$smarty->assign('gbfp_keepaspectratio_text', $this->Lang('keep_aspectratio'));
			$smarty->assign('gbfp_keepaspectratio_input',
				$this->CreateInputHidden($id,'keep_aspectratio',0).
				$this->CreateInputCheckbox($id, 'keep_aspectratio', '1',1));
			
			$smarty->assign('gbfp_forceupscaling_text', $this->Lang('force_upscaling'));
			$smarty->assign('gbfp_forceupscaling_input',
				$this->CreateInputHidden($id,'force_upscaling',0).
				$this->CreateInputCheckbox($id, 'force_upscaling', '1',0));
		}
		$smarty->assign('gbfp_formend', $this->CreateFormEnd());
		
		/*
		// ToTo: create action upload for mode dropdown
		else
		{
			// if mode dropdown and we uploaded a file just recreate the dropdown
			$result = '';
			if(isset($errormessage))
			{
				$result .= '<div class="pageerrorcontainer"><ul class="pageerror"><li>'.$errormessage.'</li></ul></div>';
			}
			if(isset($message))
			{
				$result .= '<div class="pagemcontainer"><p class="pagemessage">'.$message.'</p></div>';
			}
			$result .= $this->CreateFileDropdown($_id,$name,
				$current_dir,
				$value,
				$params['exclude_prefix'],
				$params['include_prefix'],
				$params['exclude_sufix'],
				$params['include_sufix'],
				$params['file_extensions'],
				$params['media_type'],
				$params['allow_none'],
				$params['add_txt']);
		}
		//---
		*/
	}
}
else
{
	$errormessage = $this->Lang('dir_notfound',$current_dir);
}

if($this->_isAdmin || $params['show_subdirs'])
{
	$smarty->assign('gbfp_currentdir_text', $this->Lang('currentdir'));
	$smarty->assign_by_ref('gbfp_currentdir', $dir);
}

$smarty->assign('gbfp_id', $_id);
$smarty->assign('gbfp_mode', $params['mode']);
$smarty->assign('gbfp_delete', $usefm && $params['delete']);
$smarty->assign('gbfp_targetid', $_id.$name);
$smarty->assign('gbfp_inputid', $_id.$name);
$smarty->assign('gbfp_cssid', $_id.munge_string_to_url($name));
$smarty->assign('gbfp_is_admin', $this->_isAdmin);
$smarty->assign('gbfp_media_type', $params['media_type']);
$smarty->assign('gbfp_show_subdirs', $params['show_subdirs']);
$smarty->assign('gbfp_upload', $params['upload'] && $usefm);
$smarty->assign('gbfp_allow_scaling', $params['allow_scaling']);
$smarty->assign('gbfp_create_dirs', ($usefm && $params['show_subdirs'] && $params['create_dirs'] && ($params['mode'] != 'dropdown')));
$smarty->assign('gbfp_success_text', $this->Lang('success'));
$smarty->assign('gbfp_error_text', $this->Lang('error'));
$smarty->assign('gbfp_deleteicon', $this->GetActionIcon('delete'));
$smarty->assign('gbfp_confirm_delete_dir', $this->lang('confirm_delete_dir'));
$smarty->assign('gbfp_confirm_delete_file', $this->lang('confirm_delete_file'));

if(isset($errormessage))
{
	$smarty->assign_by_ref('gbfp_errormessage', $errormessage);
}
if(isset($message))
{
	$smarty->assign_by_ref('gbfp_message', $message);
}

$ajax = isset($params['ajax']) && $this->IsTrue($params['ajax']);
$xml  = $ajax && isset($params['xml']) && $this->IsTrue($params['xml']);

if($ajax)
{
	@ob_end_clean();
	@ob_start();
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	if($xml)
	{
		header('Content-Type: text/xml');
		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo '<result><![CDATA[';
	}
	else
	{
		header('Content-type: text/html; charset=utf-8');
	}
}

echo $this->ProcessTemplate($params['filebrowser_template']);

if($ajax)
{
	if($xml)
	{
		echo ']]></result>';
	}
	@ob_end_flush();
	exit;
}
?>