<?php
#-------------------------------------------------------------------------------
#
# Module : GBFilePicker (c) 2010-2012 by Georg Busch (georg.busch@gmx.net)
#          a file picker tool for CMS Made Simple
#          The projects homepage is: dev.cmsmadesimple.org/projects/gbfilepicker
#          CMS Made Simple is (c) 2004-2012 by Ted Kulp
#          The projects homepage is: cmsmadesimple.org
# Version: 1.3.3
# File   : GBFilePicker.module.php
# Purpose: main module class
# License: GPL
#
#-------------------------------------------------------------------------------

$cfg = cmsms()->GetConfig();
define('GBFP_THUMBNAILS_PATH', cms_join_path($cfg['uploads_path'] , 'GBFilePickerThumbs'));

/**
 * Class definition and methods for GBFilePicker
 *
 * @package CMSModule
 * @license GPL
 */

/**
 * Main class of the GBFilePicker Module
 *
 * @author Georg Busch (NaN)
 * @copyright 2010-2012 Georg Busch (NaN)
 * @version 1.3.3
 *
 * @package CMSModule
 * @license GPL
 */
class GBFilePicker extends CMSModule
{
	/**
	 * @access protected
	 * @var boolean
	 * @ignore
	 */
	protected $_isAdmin;
	
	/**
	 * @access protected
	 * @var boolean
	 * @ignore
	 */
	protected $_loaded;
	
	/**
	 * @access protected
	 * @var string
	 * @ignore
	 */
	protected $_username;
	
	/**
	 * @access protected
	 * @var string
	 * @ignore
	 */
	protected $_pp = '<div style="float:right"><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick" />
<input type="hidden" name="hosted_button_id" value="FA2D3FPLSTAKJ" />
<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online." />
<img alt="" border="0" src="https://www.paypal.com/de_DE/i/scr/pixel.gif" width="1" height="1" />
</form></div>';

	/**
	 * Constructor
	 * @ignore
	 */
	function __construct()
	{
		parent::__construct();
		$this->_loaded = false;
		global $CMS_ADMIN_PAGE;
		$config = cmsms()->GetConfig();
		if(isset($CMS_ADMIN_PAGE) && $CMS_ADMIN_PAGE == 1)
		{
			if(!is_dir(GBFP_THUMBNAILS_PATH))
			{
				@mkdir(GBFP_THUMBNAILS_PATH, 0755);
			}
			$userops        =& cmsms()->GetUserOperations();
			$this->_isAdmin = $this->CheckPermission('gbfp_dummy_permission');
			if($user =& $userops->LoadUserById(get_userid(false)))
			{
				$this->_username = $user->username;
			}
		}
		$smarty = cmsms()->GetSmarty();
		$smarty->register_function('gbfp_jsloader', array('gbfp_smarty_plugins','gbfp_jsloader'));
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetName
	 * @ignore
	 */
	function GetName()
	{
		return 'GBFilePicker';
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetFriendlyName
	 * @ignore
	 */
	function GetFriendlyName()
	{
		return $this->Lang('GBFilePicker');
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetVersion
	 * @ignore
	 */
	function GetVersion()
	{
		return '1.3.3';
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetHelp
	 * @ignore
	 */
	function GetHelp()
	{
		return $this->_pp.$this->lang('help');
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetAuthor
	 * @ignore
	 */
	function GetAuthor()
	{
		return 'Georg Busch (NaN)';
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetChangeLog
	 * @ignore
	 */
	function GetChangeLog()
	{
		return $this->_pp.$this->lang('changelog');
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#HasAdmin
	 * @ignore
	 */
	function HasAdmin()
	{
		return $this->CheckPermission('Manage GBFilePicker');
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetAdminSection
	 * @ignore
	 */
	function GetAdminSection()
	{
		return 'extensions';
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetAdminDescription
	 * @ignore
	 */
	function GetAdminDescription()
	{
		return $this->lang('admindescription');
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#VisibleToAdminUser
	 * @ignore
	 */
	function VisibleToAdminUser()
	{
		return $this->CheckPermission('Manage GBFilePicker');
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#MinimumCMSVersion
	 * @ignore
	 */
	function MinimumCMSVersion()
	{
		return "1.8";
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#MaximumCMSVersion
	 * @ignore
	 */
	function MaximumCMSVersion()
	{
		return "1.12";
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#InstallPostMessage
	 * @ignore
	 */
	function InstallPostMessage()
	{
		return $this->Lang('post_install', $this->GetVersion());
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#UninstallPostMessage
	 * @ignore
	 */
	function UninstallPostMessage()
	{
		return $this->Lang('post_uninstall', $this->GetVersion());
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#UninstallPreMessage
	 * @ignore
	 */
	function UninstallPreMessage()
	{
		return $this->Lang('confirm_uninstall');
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#HandlesEvents
	 * @ignore
	 */
	function HandlesEvents()
	{
		return false;
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#IsPluginModule
	 * @ignore
	 */
	function IsPluginModule()
	{
		return false;
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#DoAction
	 * @ignore
	 */
	function DoAction($action, $id, $params, $returnid = '')
	{
		switch($action)
		{
			case 'upload':
			case 'savePrefs':
			case 'fileBrowser':
			case 'defaultadmin':
			case 'reloadDropdown':
				parent::DoAction($action, $id, $params, $returnid);
				break;
			case 'delete':
				unset($params['action']);
				parent::DoAction('fileBrowser', $id, $params, $returnid);
				break;
			default: break;
		}
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#HasCapability
	 * @ignore
	 */
	function HasCapability($capability,$params = array())
	{
		switch( $capability )
		{
			case 'contentblocks':
			case 'content_attributes':
				return TRUE;
			default:
				return FALSE;
		}
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetContentBlockInput
	 * @ignore
	 */
	function GetContentBlockInput($blockname,$value,$params,$adding = false)
	{
		if($this->CheckPermission('Use GBFilePicker'))
		{
			if(isset($params['smarty']) && $this->IsTrue($params['smarty']))
			{
				foreach($params as $k=>$v)
				{
					$params[$k] = $this->DoSmarty($v);
				}
			}
			return $this->CreateFilePickerInput($this, '', str_replace(' ','_',$blockname), $value, $params);
		}
		return;
	}
	
#-------------------------------------------------------------------------------
# Not part of the CMSms module API
#-------------------------------------------------------------------------------
	
	/**
	 * Creates the filepicker input.
	 *
	 * @since 1.0
	 * @access public
	 * @deprecated
	 *
	 * @param object &$module - deprecated
	 * @param string $id - the id of the moduleinstance that creates the filepicker input
	 * @param string $name - the name of the input field
	 * @param string $value - the preselected value
	 * @param array $params - the input params (param_name => param_value):<br /><ul>
	 *        <li>(string)  'feu_access'               => a csv of group ids of the frontend users module,</li>
	 *        <li>(boolean) 'restrict_users_diraccess' => set to true if user may only access a dir of his username (notice: this has no effect if you are admin; in frontend this will always be true),</li>
	 *        <li>(string)  'header_template'          => specify wich template should be used to create the html output that will be placed in the &lt;head&gt; section (default is header.tpl of the selected theme of GBFilePickers preferences),</li>
	 *        <li>(string)  'input_template'           => specify wich template should be used to create the input elements (default is input.tpl of the selected theme of GBFilePickers preferences),</li>
	 *        <li>(string)  'upload_template'          => specify wich template should be used to create the upload form of mode dropdown (default is upload.tpl of the selected theme of GBFilePickers preferences),</li>
	 *        <li>(string)  'filebrowser_template'     => specify wich template should be used to create the filebrowser output (default is fileBrowser.tpl of the selected theme of GBFilePickers preferences),</li>
	 *        <li>(string)  'prompt'                   => the prompt of the input field,</li>
	 *        <li>(string)  'media_type'               => the media type (at the moment only image / file are supported),</li>
	 *        <li>(mixed)   'file_extensions'          => an array or a csv of allowed file extensions (deprecated),</li>
	 *        <li>(mixed)   'exclude_prefix'           => an array or a csv of file prefixes that will be excluded (deprecated),</li>
	 *        <li>(mixed)   'exclude_sufix'            => an array or a csv of file suffixes that will be excluded (deprecated),</li>
	 *        <li>(mixed)   'include_prefix'           => an array or a csv of file prefixes that will be included (deprecated),</li>
	 *        <li>(mixed)   'include_sufix'            => an array or a csv of file suffixes that will be included (deprecated),</li>
	 *        <li>(boolean) 'show_subdirs'             => set to true if user may browse subdirs (notice: this has no effect if you are admin)</li>
	 *        <li>(string)  'mode'                     => dropdown/browser,</li>
	 *        <li>(boolean) 'allow_none'               => set to false if the option "none" should not be shown (notice: this has no effect if you are admin),</li>
	 *        <li>(boolean) 'lock_input'               => set to false if user may enter the path in the inputfield ('mode'=>'browser', 'media_type' => 'file') (notice: this has no effect if you are admin),</li>
	 *        <li>(boolean) 'upload'                   => set to true if user may upload files (notice: this has no effect if you are admin or have permission to modify files),</li>
	 *        <li>(boolean) 'delete'                   => set to true if user may delete files/dirs (notice: this has no effect if you are admin or have permission to modify files),</li>
	 *        <li>(boolean) 'create_dirs'              => set to true if user may create dirs (notice: this has no effect if you are admin or have permission to modify files),</li>
	 *        <li>(string)  'add_txt'                  => any additional text that will be added to the html input when tag is rendered,</li>
	 *        <li>(integer) 'size'                     => the size of the textinput ('mode' => 'browser', 'media_type' => 'file' only),</li>
	 *        <li>(integer) 'maxlength'                => the max length of the textinput ('mode' => 'browser', 'media_type' => 'file' only),</li>
	 *        <li>(integer) 'scaling_width'            => the default width of images when allow_scaling is true,</li>
	 *        <li>(integer) 'scaling_height'           => the default height of images when allow_scaling is true,</li>
	 *        <li>(boolean) 'show_thumbfiles'          => set to true if thumbs should also be shown as regular files,</li>
	 *        <li>(boolean) 'allow_scaling'            => set to false if user may not scale the images on upload,</li>
	 *        <li>(boolean) 'create_thumbs'            => set to false if the module may not create thumbs for the input,</li>
	 *        <li>(boolean) 'allow_upscaling'          => set to true if user may enlarge the images</li>
	 *        <li>(boolean) 'force_scaling'            => set to true to force resizing of image to a given size if user may not resize images</li>
	 *        <li>(boolean) 'keep_aspectratio'         => set to false to change aspect ratio to that one of the scaling size on resizing images</li></ul>
	 * @param integer $returnid - the page id to return to and to print out the result after module has finished its task;<br />usually this has nothing to say but is required for frontend usage (must be an existing content id)
	 *
	 * @return string - the HTML output of the filepicker
	 */
	public function CreateFilePickerInput(&$module, $id, $name, $value = '', $params = array(), $returnid = '')
	{
		$config = cmsms()->GetConfig();
		$smarty = cmsms()->GetSmarty();
		if(class_exists('cms_utils') && cms_utils::get_current_pageid() && $returnid == '')
			$returnid = cms_utils::get_current_pageid();
		
		$name = str_replace(' ','_',$name);
		if(!$params =& $this->SetInputParams('', $id, $name, $params))
			return;
		
		$output = '';
		$value  = $this->CleanUrl($value, false);
		$smarty->assign('thumb_width', get_site_preference('thumbnail_width',96));
		$smarty->assign('thumb_height', get_site_preference('thumbnail_height',96));
		
		if($params['media_type'] == 'image')
		{
			$thumbnail_size = $this->GetThumbnailSize($value);
			$smarty->assign('gbfp_thumb_width', $thumbnail_size[0]);
			$smarty->assign('gbfp_thumb_height', $thumbnail_size[1]);
			$smarty->assign('gbfp_thumburl', $this->GetThumbnail($value, $params['create_thumbs'],true));
		}
		$smarty->assign('gbfp_value', $value);
		$smarty->assign('gbfp_loaded', $this->_loaded);
		
		$input       = '';
		$upload_link = '';
		$browse_link = '';
		$clear_link  = '';
		$reload_link = '';
		$upload_url  = '';
		$browse_url  = '';
		$reload_url  = '';
		
		$filebrowser_url = str_replace('&amp;','&',$this->CreateLink(($id == '' ? 'm1_' : $id), 'fileBrowser', $returnid, '',array('name' =>$name,'dir'=>($this->_isAdmin?$params['dir']:'')),'', true));
		
		if($params['mode'] == 'dropdown')
		{
			$input = $this->CreateFileDropdown(
				$id,
				$name,
				$params['dir'],
				$value,
				$params['exclude_prefix'],
				$params['include_prefix'],
				$params['exclude_sufix'],
				$params['include_sufix'],
				$params['file_extensions'],
				$params['media_type'],
				$params['allow_none'],
				$params['add_txt']);
			
			if($params['upload'])
			{
				$upload_url  = str_replace('&amp;','&',$this->CreateLink(($id == '' ? 'm1_' : $id), 'upload', $returnid, $this->lang('upload'),array('name' =>$name,'dir'=>($this->_isAdmin?$params['dir']:'')),'', true));
				$upload_link = $this->CreateLink(($id == '' ? 'm1_' : $id), 'upload', $returnid, $this->lang('upload'), array('name' =>$name), '', false, false, 'id="'.$id.munge_string_to_url($name).'_GBFP_upload" class="GBFP_link GBFP_upload"');
			}
			
			$reload_url  = str_replace('&amp;','&',$this->CreateLink(($id == '' ? 'm1_' : $id),'reloadDropdown',$returnid,$this->lang('reload_dropdown'),array('name' =>$name,'dir'=>($this->_isAdmin?$params['dir']:'')),'',true));
			$reload_link = $this->CreateLink(($id == '' ? 'm1_' : $id), 'reloadDropdown', $returnid, $this->lang('reload_dropdown'), array('name' =>$name), '', false, false, 'id="'.$id.munge_string_to_url($name).'_GBFP_reload_dropdown" class="GBFP_link GBFP_reload_dropdown"');
		}
		else if($params['mode'] == 'browser')
		{
			if($params['media_type'] == 'image')
				$input = '<input id="'.$id.munge_string_to_url($name).'" class="GBFP_input GBFP_hiddeninput" type="hidden" name="'.$id.$name.'" value="' . $value . '" />';
			else if($params['media_type'] == 'file')
				$input = '<input id="'.$id.munge_string_to_url($name).'" class="GBFP_input GBFP_textinput" type="text"' . ($params['lock_input']?' disabled="disabled"':'') . ($params['add_txt'] != ''? ' '.$params['add_txt'].' ':'') . ($params['size'] != ''?' size="' . $params['size'] . '"':'') . ($params['maxlength'] != ''?' maxlength="' . $params['maxlength'] . '"':'') . ' name="' . $id.$name . '" value="' . $value . '" />';
			
			$browse_url  = str_replace('&amp;','&',$this->CreateLink(($id == '' ? 'm1_' : $id), 'fileBrowser', $returnid, $this->lang('browse_'.$params['media_type']),array('name' =>$name,'dir'=>($this->_isAdmin?$params['dir']:'')),'', true));
			$browse_link = $this->CreateLink(($id == '' ? 'm1_' : $id), 'fileBrowser', $returnid, $this->lang('browse_'.$params['media_type']), array('name' =>$name,'dir'=>($this->_isAdmin?$params['dir']:'')), '', false, false, 'id="'.$id.munge_string_to_url($name).'_GBFP_browse" class="GBFP_link GBFP_browse"');
			if($params['allow_none'])
				$clear_link = '<a href="#" onclick="document.getElementById(\''.$id.munge_string_to_url($name).'\').value = \'\';return false;" id="'.$id.munge_string_to_url($name).'_GBFP_clear" class="GBFP_link GBFP_clear">'.$this->lang('none').'</a>';
		}
		
		$smarty->assign('gbfp_filebrowser_url', $filebrowser_url);
		$smarty->assign('gbfp_input', $input);
		$smarty->assign('gbfp_upload_url', $upload_url);
		$smarty->assign('gbfp_upload_link', $upload_link);
		$smarty->assign('gbfp_reload_dropdown_url', $reload_url);
		$smarty->assign('gbfp_reload_dropdown_link', $reload_link);
		$smarty->assign('gbfp_browse_url', $browse_url);
		$smarty->assign('gbfp_browse_link', $browse_link);
		$smarty->assign('gbfp_clear_link', $clear_link);
		
		$smarty->assign('gbfp_name', $name);
		$smarty->assign('gbfp_inputid', $id.$name);
		$smarty->assign('gbfp_cssid', $id.munge_string_to_url($name));
		
		$smarty->assign('gbfp_title', $this->Lang('browser_title'));
		$smarty->assign('debug',$config['debug'] ? 'true' : '\'\'');
		foreach($params as $k => $v)
			$smarty->assign('gbfp_'.$k,$v);
		
		$smarty->assign('gbfp_id', ($id == '' ? 'm1_' : $id));
		$smarty->assign('gbfp_reload_dir_text', $this->lang('reload_dir'));
		$smarty->assign('gbfp_clear_cache_text', $this->lang('clear_cache'));
		$smarty->assign('gbfp_close_text', $this->lang('close'));
		$smarty->assign('gbfp_upload_text', $this->lang('upload'));
		$smarty->assign('gbfp_browse_text', $this->lang('browse_'.$params['media_type']));
		if(!$this->_loaded)
		{
			if(version_compare(CMS_VERSION, '1.11') < 0)
			{
				$this->smarty->assign('jq_ui_css', $config['root_url'] . '/modules/' . $this->GetName() . '/css/jquery-ui/base/jquery.ui.all.css');
				$themeName = get_class(cmsms()->variables['admintheme']);
				if(endswith($themeName, 'Theme'))
					$themeName = substr($themeName, 0, strlen($themeName)-5);
			}
			else
				$themeName = cms_utils::get_theme_object()->themeName;
			
			if(version_compare(CMS_VERSION, '1.10') < 0)
				$admin_url = $config['root_url'] . '/' . $config['admin_dir'];
			else
				$admin_url = $config['admin_url'];
				
			$smarty->assign('expand_img', 
				$admin_url . '/themes/' . $themeName . '/images/icons/system/expand.gif',
				'','','','systemicon'
			);
			$smarty->assign('contract_img', 
				$admin_url . '/themes/' . $themeName . '/images/icons/system/contract.gif',
				'','','','systemicon'
			);
			
			if(endswith($params['header_template'],'.tpl'))
				$output = $this->ProcessTemplate($params['header_template']);
			else
				$output = $this->ProcessTemplateFromDatabase($params['header_template']);
		}
		$this->_loaded = true;
		if(endswith($params['input_template'],'.tpl'))
			return $output . $this->ProcessTemplate($params['input_template']);
		
		return $output . $this->ProcessTemplateFromDatabase($params['input_template']);
	}
	
	
	/**
	 * @since 1.1
	 * @access private
	 * @ignore
	 */
	private function &SetInputParams($module, $id, $name, $params = array())
	{
		global $CMS_ADMIN_PAGE;
		$config = cmsms()->GetConfig();
		@session_start();
		$_SESSION['GPFP_' . ($id == '' ? 'm1_' : $id).$name] = array();
		$result = false;
		$name = str_replace(' ','_',$name);
		if(!$session_params =& $this->GetInputParams($id, $name))
			return $result;
		
		if(isset($params['prompt']))
			$session_params['prompt'] = $params['prompt'];
		
		if(isset($params['header_template']))
			$session_params['header_template'] = $params['header_template'];
		if(isset($params['input_template']))
			$session_params['input_template'] = $params['input_template'];
		if(isset($params['upload_template']))
			$session_params['upload_template'] = $params['upload_template'];
		if(isset($params['filebrowser_template']))
			$session_params['filebrowser_template'] = $params['filebrowser_template'];
		
		$session_params['module'] = $this->GetName();
		if(isset($params['feu_access']))
		{
			if(!is_array($params['feu_access']))
				$session_params['feu_access'] = $this->CleanArray(explode(',',$params['feu_access']));
			else
				$session_params['feu_access'] = $this->CleanArray($params['feu_access']);
		}
		if(isset($params['restrict_users_diraccess']) && $this->IsFalse($params['restrict_users_diraccess']))
			$session_params['restrict_users_diraccess'] = false;
		
		$dir = $session_params['start_dir'];
		if(isset($params['dir']) && $params['dir'] != '')
		{
			$dir = $this->CleanUrl($params['dir'],false);
			if(!$this->_isAdmin)
				$session_params['start_dir'] = $dir;
		}
		
		if(isset($CMS_ADMIN_PAGE) && $CMS_ADMIN_PAGE == 1)
		{
			check_login();
			if(!$this->CheckPermission('Use GBFilePicker'))
				return $result;
			
			$username = $this->_username;
		}
		else
		{
			if( !$feusers =& $this->GetModuleInstance('FrontEndUsers' ) )
				return $result;
			if(!$userid = $feusers->LoggedInId())
				return $result;
			if(!$groups = $feusers->GetMemberGroupsArray($userid))
				return $result;
			$access = false;
			foreach($groups as $_group)
			{
				if(in_array($_group['groupid'],$session_params['feu_access']))
				{
					$access = true;
					break;
				}
			}
			if(!$access)
				return $result;
			
			$username = $feusers->GetUserName($userid);
			$params['media_type'] = 'image';
			$params['restrict_users_diraccess'] = true;
		}
		
		if(!$this->_isAdmin && $session_params['restrict_users_diraccess'])
		{
			if(!in_array($username, $this->CleanArray(explode('/',$dir))))
				$session_params['start_dir'] .= '/' . $dir;
			else
				$session_params['start_dir'] = $dir;
			
			$_dir = $this->CleanPath($session_params['start_dir']);
			@mkdir($_dir, 0755, true);
			if(!is_dir($_dir) || !is_readable($_dir))
				return $result;
		}
		
		if(isset($params['media_type']))
			$session_params['media_type'] = strtolower($params['media_type']);
		
		if($session_params['media_type'] == 'file')
			$session_params['file_extensions'] = array();
		if(isset($params['file_extensions']) && $params['file_extensions'] != '')
		{
			$_file_ext = $this->CleanArray(explode(',',strtolower($params['file_extensions'])));
			if($session_params['media_type'] == 'image')
				$_file_ext = $this->CleanArray(array_intersect($_file_ext, array('jpg','jpeg','gif','png')));
			if(empty($_file_ext))
				$_file_ext = $session_params['file_extensions'];
			$session_params['file_extensions'] = $_file_ext;
		}
		if(isset($params['exclude_prefix']))
			$session_params['exclude_prefix'] = trim($params['exclude_prefix']);
		if(isset($params['exclude_sufix']))
			$session_params['exclude_sufix'] = trim($params['exclude_sufix']);
		if(isset($params['include_prefix']))
			$session_params['include_prefix'] = trim($params['include_prefix']);
		if(isset($params['include_sufix']))
			$session_params['include_sufix'] = trim($params['include_sufix']);
		
		if(isset($params['show_subdirs']) && $this->IsTrue($params['show_subdirs']))
			$session_params['show_subdirs'] = true;
		else if(isset($params['show_subdirs']) && $this->IsFalse($params['show_subdirs']) && !$this->_isAdmin)
			$session_params['show_subdirs'] = false;
		
		if(isset($params['mode']))
			$session_params['mode'] = strtolower($params['mode']);
		if(isset($params['allow_none']) && $this->IsFalse($params['allow_none']) && !$this->_isAdmin)
			$session_params['allow_none'] = false;
		
		if(isset($params['lock_input']) && $this->IsFalse($params['lock_input']))
			$session_params['lock_input'] = false;
		else if(isset($params['lock_input']) && $this->IsTrue($params['lock_input']) && !$this->_isAdmin)
			$session_params['lock_input'] = true;
		
		if(isset($params['upload']) && $this->IsTrue($params['upload']) && $this->GetPreference('show_filemanagement'))
			$session_params['upload'] = true;
		else if(isset($params['upload']) && $this->IsFalse($params['upload']) && !$this->_isAdmin)
			$session_params['upload'] = false;
		
		if(isset($params['delete']) && $this->IsTrue($params['delete']) && $this->GetPreference('show_filemanagement'))
			$session_params['delete'] = true;
		else if(isset($params['delete']) && $this->IsFalse($params['delete']) && !$this->_isAdmin)
			$session_params['delete'] = false;
		
		if(isset($params['create_dirs']) && $this->IsTrue($params['create_dirs']) && $this->GetPreference('show_filemanagement'))
		{
			$session_params['create_dirs']  = true;
			$session_params['show_subdirs'] = true;
		}
		else if(isset($params['create_dirs']) && $this->IsFalse($params['create_dirs']) && !$this->_isAdmin)
			$session_params['create_dirs'] = false;
		
		if(isset($params['add_txt']))
			$session_params['add_txt'] = trim($params['add_txt']);
		if(isset($params['size']))
			$session_params['size'] = intval($params['size']);
		if(isset($params['maxlength']))
			$session_params['maxlength'] = intval($params['maxlength']);
		if(isset($params['scaling_width']))
			$session_params['scaling_width'] = intval($params['scaling_width']);
		if(isset($params['scaling_height']))
			$session_params['scaling_height'] = intval($params['scaling_height']);
		if(isset($params['show_thumbfiles']))
			$session_params['show_thumbfiles'] = intval($params['show_thumbfiles']);
		if(isset($params['allow_scaling']))
			$session_params['allow_scaling'] = intval($params['allow_scaling']);
		if(isset($params['create_thumbs']))
			$session_params['create_thumbs'] = intval($params['create_thumbs']);
		if(isset($params['allow_upscaling']))
			$session_params['allow_upscaling'] = intval($params['allow_upscaling']);
		if(isset($params['force_scaling']))
			$session_params['force_scaling'] = intval($params['force_scaling']);
		if(isset($params['keep_aspect_ratio']))
			$session_params['keep_aspect_ratio'] = intval($params['keep_aspect_ratio']);
		
		if($session_params['mode'] == 'dropdown')
		{
			$session_params['dir']       = $dir;
			$session_params['start_dir'] = $dir;
		}
		
		$_SESSION['GBFP_id_'.$name] = ($id == '' ? 'm1_' : $id);
		
		$_SESSION['GPFP_' . ($id == '' ? 'm1_' : $id).$name] = $session_params;
		
		$session_params['dir'] = $dir;
		return $session_params;
	}
	
	
	/**
	 * @since 1.1
	 * @access protected
	 * @ignore
	 */
	protected function &GetInputParams($id, $name)
	{
		$name   = str_replace(' ','_',$name);
		$params = array(
			'id'                       => $id,
			'name'                     => $name,
			'module'                   => $this->GetName(),
			'start_dir'                => '',
			'feu_access'               => $this->CleanArray(explode(',',$this->GetPreference('feu_access'))),
			'restrict_users_diraccess' => intval($this->GetPreference('restrict_users_diraccess', false)),
			'prompt'                   => '',
			'media_type'               => 'image',
			'file_extensions'          => array('jpg','jpeg','gif','png'),
			'exclude_prefix'           => '',
			'exclude_sufix'            => '',
			'include_prefix'           => '',
			'include_sufix'            => '',
			'show_subdirs'             => intval($this->_isAdmin),
			'mode'                     => 'dropdown',
			'allow_none'               => true,
			'lock_input'               => intval(!$this->_isAdmin),
			'upload'                   => intval($this->_isAdmin || ($this->GetPreference('show_filemanagement', false) && $this->CheckPermission('Modify Files'))),
			'delete'                   => intval($this->_isAdmin || ($this->GetPreference('show_filemanagement', false) && $this->CheckPermission('Modify Files'))),
			'create_dirs'              => intval($this->_isAdmin || ($this->GetPreference('show_filemanagement', false) && $this->CheckPermission('Modify Files'))),
			'add_txt'                  => '',
			'size'                     => '',
			'maxlength'                => '',
			'scaling_width'            => intval($this->GetPreference('scaling_width', '')),
			'scaling_height'           => intval($this->GetPreference('scaling_height', '')),
			'show_thumbfiles'          => intval($this->GetPreference('show_thumbfiles', false)),
			'allow_scaling'            => intval($this->GetPreference('allow_scaling', false) || $this->_isAdmin),
			'create_thumbs'            => intval($this->GetPreference('create_thumbs', true)),
			'allow_upscaling'          => intval($this->GetPreference('allow_upscaling', false) || $this->_isAdmin),
			'force_scaling'            => intval($this->GetPreference('force_scaling',false)),
			'keep_aspect_ratio'        => intval($this->GetPreference('keep_aspectratio',true)));
		
		global $CMS_ADMIN_PAGE;
		$config = cmsms()->GetConfig();
		$result = false;
		if(isset($CMS_ADMIN_PAGE) && $CMS_ADMIN_PAGE == 1)
		{
			check_login();
			if(!$this->CheckPermission('Use GBFilePicker'))
				return $result;
			if(!$this->_isAdmin && $params['restrict_users_diraccess'])
				$params['start_dir'] = $this->_username;
			
			$params['input_template'] = 'themes/'.$this->GetPreference('default_admin_theme','Default-AJAX').'/input.tpl';
			$params['filebrowser_template'] = 'themes/'.$this->GetPreference('default_admin_theme','Default-AJAX').'/fileBrowser.tpl';
			$params['upload_template'] = 'themes/'.$this->GetPreference('default_admin_theme','Default-AJAX').'/upload.tpl';
			$params['header_template'] = 'themes/'.$this->GetPreference('default_admin_theme','Default-AJAX').'/header.tpl';
		}
		else
		{
			if( !$feusers =& $this->GetModuleInstance('FrontEndUsers' ) )
				return $result;
			if(!$userid = $feusers->LoggedInId())
				return $result;
			if(!$groups = $feusers->GetMemberGroupsArray($userid))
				return $result;
			
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
				return $result;
			
			$params['input_template'] = 'themes/'.$this->GetPreference('default_frontend_theme','Default-AJAX').'/input.tpl';
			$params['filebrowser_template'] = 'themes/'.$this->GetPreference('default_frontend_theme','Default-AJAX').'/fileBrowser.tpl';
			$params['upload_template'] = 'themes/'.$this->GetPreference('default_frontend_theme','Default-AJAX').'/upload.tpl';
			$params['header_template'] = 'themes/'.$this->GetPreference('default_frontend_theme','Default-AJAX').'/header.tpl';
			$params['restrict_users_diraccess'] = true;
			$params['start_dir'] = $feusers->GetPreference('image_destination_path', 'feusers') . '/' . $feusers->GetUserName($userid);
		}
		
		if(isset($_SESSION['GPFP_' . ($id == '' ? 'm1_' : $id).$name]))
		{
			$params = array_merge($params, $_SESSION['GPFP_' . ($id == '' ? 'm1_' : $id).$name]);
			return $params;
		}
		return $params;
	}
	
	/**
	 * Gets the file type of a file.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param string $file - the path to a file
	 * @param string $use_mime - set to true to detect file type by mime type
	 *
	 * @return string - the mime-type or file extension
	 */
	public function GetFileType($file, $use_mime = false)
	{
		$filetype = '';
		if($use_mime)
		{
			if (version_compare(PHP_VERSION, '5.3.0') >= 0 && function_exists('finfo_open'))
			{
				$finfo    = finfo_open(FILEINFO_MIME_TYPE);
				$filetype = finfo_file($finfo, $file);
				finfo_close($finfo);
			}
			else if(function_exists('mime_content_type'))
				$filetype = mime_content_type($file);
		}
		else
		{
			$fileinfo = pathinfo($file);
			if(isset($fileinfo['extension']))
				$filetype = $fileinfo['extension'];
		}
		return strtolower($filetype);
	}
	
	
	/**
	 * Create a dropdown form element containing a list of files that match certain conditions
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param string $id - the id of the moduleinstance that creates the filepicker input
	 * @param string $name - the name of the input field
	 * @param string $dir - the directory to list the files of (may be relative to uploads dir or absolute path)
	 * @param string $selected - the preselected value
	 * @param array|string $excl_prefix - fileprefixes to exclude (array('foo','bar',...) or csv)
	 * @param array|string $incl_prefix - fileprefixes to include (array('foo','bar',...) or csv)
	 * @param array|string $excl_sufix - filesufixes to exclude (array('foo','bar',...) or csv)
	 * @param array|string $incl_sufix - filesufixes to include (array('foo','bar',...) or csv)
	 * @param array|string $file_ext - filesufixes to include (array('foo','bar',...) or csv)
	 * @param string $media_type - file or image
	 * @param boolean $allow_none - set to false to hide the option 'none'
	 * @param string $add_txt - any additional text that will be added to the html input when tag is rendered
	 *
	 * @return string - the HTML output of a select element with options
	 */
	public function CreateFileDropdown($id, $name, $dir = '', $selected = '', $excl_prefix = '', $incl_prefix = '',
		$excl_sufix = '', $incl_sufix = '', $file_ext = '', $media_type = '', $allow_none = true, $add_txt = '')
	{
		$files =& $this->GetInputFiles($id, $name, $dir);
		if(empty($files) && !$allow_none)
			return $this->lang('dir_empty');
		
		$dropdown = '<select class="GBFP_input GBFP_dropdown GBFP_'.$media_type.'" name="'.$id.$name.'" id="'.$id.munge_string_to_url($name).'"';
		if($add_txt != '')
			$dropdown .= ' '.$add_txt;
		
		$dropdown .= '>';
		if( $allow_none )
		{
			$dropdown .= '<option value=""';
			if($selected == '')
				$dropdown .= ' selected="selected"';
			
			$dropdown .= ' thumbnail="">--- '.lang('none').' ---</option>';
		}
		foreach( $files as $file )
		{
			$dropdown .= '<option value="'.$file->relurl.'"';
			if($file->relurl == $selected)
				$dropdown .= ' selected="selected"';
			
			if($file->is_image && $media_type == 'image')
				$dropdown .= ' thumbnail="'.(isset($file->thumburl) && $file->thumburl!=''?$file->thumburl:$file->fullurl).'"';
			
			$dropdown .= '>'.$file->basename.'</option>';
		}
		$dropdown .= "</select>";
		return $dropdown;
	}
	
	
	/**
	 * Return an array containing a list of files in a directory related to a certain input.<br />
	 * Performs a non recursive search.
	 *
	 * @since 1.1
	 * @access public
	 *
	 * @param string $id - the id of the moduleinstance that creates the filepicker input
	 * @param string $name - the name of the input field
	 * @param string $dir - the directory to list the files of (may be relative to uploads dir or absolute path)
	 *
	 * @return array
	 */
	public function &GetInputFiles($id, $name, $dir)
	{
		$params =& $this->GetInputParams($id, $name);
		return $this->GetFiles($dir, $params['exclude_prefix'],
			$params['include_prefix'], $params['exclude_sufix'],
			$params['include_sufix'], $params['file_extensions'],
			$params['media_type'], ($params['mode'] == 'dropdown' ? true : !$params['show_subdirs']), $params['show_thumbfiles'],
			$params['create_thumbs']);
	}
	
	
	/**
	 * Return an array containing a list of files in a directory.<br />
	 * Performs a non recursive search.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param string $dir - the directory to list the files of (may be relative to uploads dir or absolute path)
	 * @param array|string $excl_prefix - fileprefixes to exclude (array('foo','bar',...) or csv)
	 * @param array|string $incl_prefix - fileprefixes to include (array('foo','bar',...) or csv)
	 * @param array|string $excl_sufix - filesufixes to exclude (array('foo','bar',...) or csv)
	 * @param array|string $incl_sufix - filesufixes to include (array('foo','bar',...) or csv)
	 * @param array|string $file_ext - filesufixes to include (array('foo','bar',...) or csv)
	 * @param string $media_type - file or image
	 * @param boolean $excl_dirs - set to true to exclude directories
	 * @param boolean $show_thumbfiles
	 * @param boolean $create_thumbs = true
	 *
	 * @return array
	 * @deprecated
	 */
	public function &GetFiles($dir = '', $excl_prefix = '', $incl_prefix = '', $excl_sufix = '',
		$incl_sufix = '', $file_ext = '', $media_type = 'image', $excl_dirs = false, $show_thumbfiles = false, $create_thumbs = true)
	{
		$config = cmsms()->GetConfig();
		$files  = Array();
		$dir    = $this->CleanPath($dir);
		if(!is_readable($dir))
		{
			return $files; // ToDo: display error message?
		}
		$url    = $this->CleanURL($dir);
		
		if(!file_exists($dir) || !is_dir($dir))
		{
			return $files;
		}
		
		if(!is_array($excl_prefix))
		{
			$excl_prefix = $this->CleanArray(explode(',',$excl_prefix));
		}
		
		if(!is_array($incl_prefix))
		{
			$incl_prefix = $this->CleanArray(explode(',',$incl_prefix));
		}
		
		if(!is_array($excl_sufix))
		{
			$excl_sufix = $this->CleanArray(explode(',',$excl_sufix));
		}
		
		if(!is_array($incl_sufix))
		{
			$incl_sufix = $this->CleanArray(explode(',',$incl_sufix));
		}
		
		if(!is_array($file_ext))
		{
			$file_ext = $this->CleanArray(explode(',',$file_ext));
		}
		
		$_file_ext = array('jpg','jpeg','gif','png');
		if($media_type == 'image')
		{
			$file_ext = $this->CleanArray(array_intersect($_file_ext, $file_ext));
			if(empty($file_ext))
			{
				$file_ext = $_file_ext;
			}
		}
		
		$excl_prefix = $this->CleanArray(array_diff($excl_prefix, $incl_prefix));
		$excl_sufix  = $this->CleanArray(array_diff($excl_sufix, $incl_sufix));
		
		$d = dir($dir);
		while ($entry = $d->read())
		{
			if ($entry[0] == '.' || (is_dir($dir.$entry) && $excl_dirs) || !is_readable($dir.$entry))
			{
				continue; // ToDo: how to display files/dirs with limited permission?
			}
			
			$skip        = false;
			$incl_thumbs = false;
			
			$file         = new stdClass();
			$file->is_dir = is_dir($dir.$entry);
			$fileinfo     = pathinfo($dir.$entry);
			foreach($fileinfo as $k=>$v)
			{
				$file->$k = $v;
			}
			if(!$file->is_dir)
			{
				foreach($excl_prefix as $str)
				{
					if(startswith($file->filename,$str))
					{
						$skip = true;
						break;
					}
				}
				if($skip) continue;
				
				foreach($incl_prefix as $str)
				{
					if(startswith($str,'thumb_'))
					{
						$incl_thumbs = true;
					}
					if(!startswith($file->filename,$str))
					{
						$skip = true;
						break;
					}
				}
				if($skip) continue;
				
				foreach($excl_sufix as $str)
				{
					if(endswith($file->filename,$str))
					{
						$skip = true;
						break;
					}
				}
				if($skip) continue;
				
				foreach($incl_sufix as $str)
				{
					if(!endswith($file->filename,$str))
					{
						$skip = true;
						break;
					}
				}
				if($skip)
					continue;
			}
			
			if(startswith($entry,'thumb_') && !$show_thumbfiles && !$incl_thumbs)
			{
				continue;
			}
			
			$filetype = $this->GetFileType($dir.$entry,$this->GetPreference('use_mimetype',false));
			if (!$file->is_dir && $media_type == 'image' && !in_array(str_replace('image/','',$filetype),$file_ext))
			{
				continue;
			}
			else if(!$file->is_dir && $media_type != 'image' && !in_array($file->extension,$file_ext) && !empty($file_ext))
			{
				continue;
			}
			
			$file->fullurl      = $url.$entry;
			$file->relurl       = trim(str_replace($config['uploads_url'],'',$file->fullurl),'/');
			$file->id           = munge_string_to_url($file->relurl);
			$file->last_modifed = filemtime($dir.$entry);
			
			if (!$file->is_dir)
			{
				$file->is_image = false;
				if (!$file->is_dir && in_array(str_replace('image/','',$filetype),array('jpg','jpeg','gif','png')))
				{
					$file->is_image = true;
				}
				$file->filetype = $filetype;
				if($file->is_image)
				{
					$file->thumbnail = '';
					$file->thumburl  = '';
					if ($show_thumbfiles || $incl_thumbs)
					{
						$file->thumbnail = $this->GetThumbnail($dir.str_replace('thumb_', '', $entry), $create_thumbs);
						$file->thumburl  = $this->GetThumbnail($dir.str_replace('thumb_', '', $entry), $create_thumbs,true);
					}
					else
					{
						$file->thumbnail = $this->GetThumbnail($dir.$entry, $create_thumbs);
						$file->thumburl  = $this->GetThumbnail($dir.$entry, $create_thumbs,true);
					}
					
					$file->imgsize = '';
					$imgsize = @getimagesize($dir.$entry);
					if ($imgsize)
					{
						$file->imgsize = $imgsize[0] . ' x ' . $imgsize[1];
					}
					else
					{
						$file->imgsize = '&nbsp;';
					}
				}
				$file->filesize = '';
				$info = @stat($dir.$entry);
				if ($info)
				{
					$file->filesize = $info['size'];
				}
				$file->fileicon = $this->GetFileIcon($file->extension,false,true);
			}
			else
			{
				$file->fileicon = $this->GetFileIcon('',true);
			}
			$files[] = $file;
		}
		$d->close();
		usort($files, array($this, 'SortFiles'));
		return $files;
	}
	
	
	/**
	 * Replaces all multiple DIRECTORY_SEPARATOR, dots and (multiple) slashes with one single DIRECTORY_SEPARATOR to make a clean secure path parameter
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param string $path - the path to clean
	 * @param string $full_path - true to prepend uploads path on return, false to return only the cleaned $path
	 *
	 * @return string - the clean path
	 */
	public function CleanPath($path, $full_path = true)
	{
		$config = cmsms()->GetConfig();
		$path = trim(str_replace(array($config['uploads_path'],$config['uploads_url']), '', $path),'/'.DIRECTORY_SEPARATOR);
		$path = str_replace(DIRECTORY_SEPARATOR,'/',$path);
		$path = trim(preg_replace('/(\/\.)|(\.\/)|(\/?\.\.\/?)/','/',$path),'/');
		if($full_path)
		{
			$path = preg_replace('/[\\/]+/',DIRECTORY_SEPARATOR, '/' . $path . '/');
			$path = $config['uploads_path'] . $path;
			return $path;
		}
		return trim(preg_replace('/[\\/]+/',DIRECTORY_SEPARATOR, $path) , DIRECTORY_SEPARATOR);
	}
	
	
	/**
	 * Replaces all multiple slashes, dots and (multiple) backslashes with one single slash to make a clean secure url parameter
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param string $url - the url to clean
	 * @param string $full_url - true to prepend uploads url on return, false to return only the cleaned $url
	 *
	 * @return string - the clean url
	 */
	public function CleanURL($url, $full_url = true)
	{
		$config = cmsms()->GetConfig();
		$url = trim(str_replace(array($config['uploads_path'],$config['uploads_url']), '', $url),'/'.DIRECTORY_SEPARATOR);
		$url = str_replace(DIRECTORY_SEPARATOR,'/',$url);
		$url = trim(preg_replace('/(\/\.)|(\.\/)|(\/?\.\.\/?)/','/',$url),'/');
		if($full_url)
		{
			$url = preg_replace('/\/+/','/', '/' . str_replace(array('http://', 'https://','www.'),'',$url) . '/');
			$url = $config['uploads_url'] . $url;
			return $url;
		}
		return trim(preg_replace('/\/+/','/',$url),'/');
	}
	
	
	/**
	 * Returns the thumbnail of a given image file.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param string $path - the path of the file to create a thumbnail of (can be relative to the uploads dir or absolute)
	 * @param string $create_thumb - set to false if thumbnail may not be created if not exists
	 * @param string $urlonly - set to true to get only the url to the thumbnail
	 *
	 * @return string - HTML img element or url
	 */
	public function GetThumbnail($path, $create_thumb = true, $urlonly = false)
	{
		if($path == '')
		{
			return false;
		}
		$config = cmsms()->GetConfig();
		$filename = basename($path);
		$path     = $this->CleanPath(str_replace($filename,'',$path));
		$url      = $this->CleanUrl(str_replace($filename,'',$path));
		
		if(!startswith($path, GBFP_THUMBNAILS_PATH))
		{
			$thumbnail = cms_join_path(GBFP_THUMBNAILS_PATH , 'thumb_' . munge_string_to_url(str_replace($config['uploads_path'], '', $path)) . '_' . $filename);
			if((!is_file($thumbnail) || filectime($path . $filename) > filectime($thumbnail)) && $create_thumb)
			{
				$this->HandleFileResizing($path . $filename, $thumbnail, get_site_preference('thumbnail_width', 96), get_site_preference('thumbnail_height',96),true,false,60,false);
				debug_buffer( 'Used space after image procesing ... ' . memory_get_usage() , 'GBFilePicker');
				
			}
			if(is_file($thumbnail))
			{
				$thumbUrl = $config['root_url'] . '/' . $this->CleanUrl(str_replace($config['root_path'], '', $thumbnail), false);
			}
			else
			{
				$thumbUrl = $url . $filename;
				$thumbnail_size = $this->GetThumbnailSize($path . $filename);
			}
		}
		else
		{
			$filename = 'thumb_' . $filename;
			$thumbUrl = $url . $filename;
		}
		if($urlonly)
		{
			return $thumbUrl;
		}
		return '<img class="GBFP_thumbnail"' . (isset($thumbnail_size) && is_array($thumbnail_size) ? ' width="'.$thumbnail_size[0].'" height="'.$thumbnail_size[1].'"' : '') . ' id="' . munge_string_to_url($filename) . '_GBFP_thumbnail" src="' . $thumbUrl . '" alt="' . str_replace($config['uploads_url'],'',$url) . $filename . '" title="' . str_replace($config['uploads_url'],'',$url) . $filename . '" />';
	}
	
	
	/**
	 * Creates the thumbnail of a given image file.
	 *
	 * @since 1.2.9
	 * @access public
	 *
	 * @param string $path - the path of the file to create a thumbnail from (can be relative to the uploads dir or absolute)
	 *
	 * @return string - absolute path of the thumbnail
	 */
	public function CreateThumbnail($path)
	{
		if($path == '')
		{
			return;
		}
		$config = cmsms()->GetConfig();
		$filename = basename($path);
		$path     = $this->CleanPath(str_replace($filename,'',$path));
		$thumbnail= cms_join_path(GBFP_THUMBNAILS_PATH , 'thumb_' . munge_string_to_url(str_replace($config['uploads_path'], '', $path)) . '_' . $filename);
		
		if(!is_file($thumbnail) || filectime($path . $filename) > filectime($thumbnail))
		{
			if(!$this->HandleFileResizing($path . $filename, $thumbnail, get_site_preference('thumbnail_width', 96), get_site_preference('thumbnail_height',96),true,false,60,false))
			{
				debug_buffer( 'Used space after image procesing ... ' . memory_get_usage() , 'GBFilePicker');
				return;
			}
		}
		return $thumbnail;
	}
	
	
	/**
	 * Gets the icon for a file.<br />
	 * If FileManager is installed it uses FileManager icons.<br />
	 * Otherwise it uses own icons.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param string $ext - the file extension
	 * @param bool $is_dir
	 * @param bool $is_image
	 * @return string - the HTML ouput of an image
	 */
	public function GetFileIcon($ext = '', $is_dir = false, $is_image = false)
	{
		$config = cmsms()->GetConfig();
		if($fm =& $this->GetModuleInstance('FileManager'))
			return $fm->GetFileIcon($ext, $is_dir);
		if($is_dir)
			return '<img class="GBFP_fileicon" src="'.$config['root_url'].'/modules/GBFilePicker/images/dir.gif" alt="" />';
		if ($is_image)
			return '<img class="GBFP_fileicon" src="'.$config['root_url'].'/modules/GBFilePicker/images/images.gif" alt="" />';
		return '<img class="GBFP_fileicon" src="'.$config['root_url'].'/modules/GBFilePicker/images/fileicon.gif" alt="" />';
	}
	
	
	/**
	 * Gets the icon for the file operation. <br />
	 * If FileManager is installed it uses FileManager icons. <br />
	 * Otherwise it uses own icons<br />
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param string $action - the file operation (e.g. 'delete')
	 * @return string - the HTML ouput of an image
	 */
	public function GetActionIcon($action)
	{
		$config = cmsms()->GetConfig();
		if($fm =& $this->GetModuleInstance('FileManager'))
			return $fm->GetActionIcon($action);
		else
			return '<img class="GBFP_actionicon" src="'.$config['root_url'].'/modules/GBFilePicker/images/'.$action.'.gif" title="'.$action.'" alt="'.$action.'" />';
	}
	
	
	/**
	 * Checks if a directory is empty<br />
	 * Taken from TinyMCE Module (extracted from filepicker).
	 * @since 1.0
	 * @access public
	 * @param string $dir - the path to a directory
	 * @return boolean
	 */
	public function IsDirEmpty($dir)
	{
		$d = dir($this->CleanPath($dir));
		while ($entry = $d->read())
		{
			if ($entry == '.')
				continue;
			if ($entry == '..')
				continue;
			return false;
		}
		return true;
	}
	
	
	/**
	 * Sorts the files by filename; shows directories first<br />
	 * this function is meant to be called from the php usort() function: usort($array,array($this,'SortFiles')<br />
	 * Taken from TinyMCE filepicker.
	 * @since 1.0
	 * @access public
	 * @param object $file1 - one file to compare <br />a php stdClass with properties (boolean) $is_dir - a flag that specifys if it is a dir or a file;<br />(string) $basename - the basename of the file;
	 * @param object $file2 - the other file to compare <br />a php stdClass with properties (boolean) $is_dir - a flag that specifys if it is a dir or a file;<br />(string) $basename - the basename of the file;
	 * @return integer -1 or 1
	 */
	public function SortFiles($file1, $file2)
	{
		if ($file1->is_dir && !$file2->is_dir) return -1;
		if (!$file1->is_dir && $file2->is_dir) return 1;
		return strnatcasecmp($file1->basename, $file2->basename);
	}
	
	
	/**
	 * resizes images<br />
	 * Adapted from TinyMCE filepicker.
	 * @since 1.0
	 * @access public
	 *
	 * @param string $source - the source path of the image
	 * @param string $output - the destination path of the resized image
	 * @param integer $new_width - the new wdth to scale the image to (if $keep_aspectratio is set to true this will be just some kind of max value)
	 * @param integer $new_height - the new height to scale the image to (if $keep_aspectratio is set to true this will be just some kind of max value)
	 * @param boolean $keep_aspectratio - set to false if image aspect ratio may be changed
	 * @param boolean $allow_upscaling - set to true if user may enlarge the image
	 * @param integer $quality - the quality of the new image (jpg only)
	 * @param boolean $clean_path - set to false if source is the upload_tmp_dir
	 *
	 * @todo enable format change?
	 */
	public function HandleFileResizing($source, $output, $new_width, $new_height, 
		$keep_aspectratio = true, $allow_upscaling = false, $quality = 100, $clean_path = true)
	{
		debug_buffer( 
			'Processing image ... 
			File : ' . basename($source) . '
			Memory Limit : ' . @ini_get("memory_limit") . '
			Used Space before image processing : ' . memory_get_usage(), 
			'GBFilePicker'
		);
		
		if(@ini_get("upload_tmp_dir") && !startswith($source, @ini_get("upload_tmp_dir")) && $clean_path)
			$source = $this->CleanPath(str_replace(basename($source),'',$source)).basename($source);
		
		if($clean_path)
			$output = $this->CleanPath(str_replace(basename($output),'',$output)).basename($output);
		
		$img_data = @getimagesize($source);
		
		if (!$img_data)
			return false;
		
		$required_space = $img_data[0] * $img_data[1] * 4;
		$finfo = @stat($source);
		if($finfo)
			$required_space = $required_space + $finfo['size'];
		
		debug_buffer( 'Required Space : ' . $required_space, 'GBFilePicker');
		
		if(!$this->_check_memory_limit($required_space))
			return false;
		
		switch($img_data['mime'])
		{
			case 'image/jpeg':
				$orig_image = @imagecreatefromjpeg($source);
				break;
			case 'image/gif' :
				$orig_image = @imagecreatefromgif($source);
				break;
			case 'image/png' :
				$orig_image = @imagecreatefrompng($source);
				break;
			default:
				return false;
		}
		
		if(!$orig_image)
			return false;
		
		debug_buffer('Used space during image procesing ... (Line ' . __LINE__ . '): ' . memory_get_usage(), 'GBFilePicker');
		
		$orig_width  = @imagesx($orig_image);
		$orig_height = @imagesy($orig_image);
		
		$aspectratio = $orig_width / $orig_height;
		
		$new_width  = floor($new_width);
		$new_height = floor($new_height);
		
		if($new_width <= 0 && $new_height > 0) { // force height
			$new_width = $orig_width;
			if($new_height > $orig_height && !$allow_upscaling)
			{
				$new_height = $orig_height;
			}
			if($keep_aspectratio)
			{
				$new_width = floor($new_height * $aspectratio);
			}
		}
		else if($new_height <= 0 && $new_width > 0) { // force width
			$new_height = $orig_height;
			if($new_width > $orig_width && !$allow_upscaling)
			{
				$new_width = $orig_width;
			}
			if($keep_aspectratio)
			{
				$new_height = floor($new_width / $aspectratio);
			}
		}
		else if($new_height > 0 && $new_width > 0) { // both
			if($new_width > $orig_width && !$allow_upscaling)
			{
				$new_width = $orig_width;
			}
			if($new_height > $orig_height && !$allow_upscaling)
			{
				$new_height = $orig_height;
			}
			$new_aspectratio = $new_width / $new_height;
			if($keep_aspectratio)
			{
				if($aspectratio > 1 && $new_aspectratio < 1)
				{ // landscape to portrait
					$_tmp = floor($new_width / $aspectratio);
					if($_tmp > 0 && $_tmp <= $new_height)
					{
						$new_height = $_tmp;
					}
				}
				else if($aspectratio < 1 && $new_aspectratio > 1)
				{ // portrait to landscape
					$_tmp = floor($new_height * $aspectratio);
					if($_tmp > 0 && $_tmp <= $new_width)
					{
						$new_width = $_tmp;
					}
				}
				else
				{
					if($new_aspectratio < $aspectratio)
					{
						$_tmp = floor($new_width / $aspectratio);
						if($_tmp > 0 && $_tmp <= $new_height)
						{
							$new_height = $_tmp;
						}
					}
					else if($new_aspectratio > $aspectratio)
					{
						$_tmp = floor($new_height * $aspectratio);
						if($_tmp > 0 && $_tmp <= $new_width)
						{
							$new_width = $_tmp;
						}
					}
				}
			}
		}
		else
		{
			$new_height = $orig_height;
			$new_width  = $orig_width;
		}
		
		if($new_width < 1)
		{
			$new_width = 1;
		}
		if($new_height < 1)
		{
			$new_height = 1;
		}
		
		$new_image = @imagecreatetruecolor(floor($new_width), floor($new_height));
		
		debug_buffer('Used space during image procesing ... (Line ' . __LINE__ . '): ' . memory_get_usage(), 'GBFilePicker');
		
		// handle transparency (adapted from supersizer plugin)
		if($img_data['mime'] == 'image/gif')
		{
			@imagetruecolortopalette($new_image, true, 256);
			@imagealphablending($new_image, false);
			@imagesavealpha($new_image,true);
			$transparent = @imagecolorallocatealpha($new_image, 255, 255, 255, 127);
			@imagefilledrectangle($new_image, 0, 0, $new_width, $new_height, $transparent);
			@imagecolortransparent($new_image, $transparent);
		}
		else if ($img_data['mime'] == 'image/png')
		{
			@imagecolortransparent($new_image, @imagecolorallocate($new_image, 0, 0, 0));   
			@imagealphablending($new_image, false);
			$color = @imagecolorallocatealpha($new_image, 0, 0, 0, 127);
			@imagefill($new_image, 0, 0, $color);
			@imagesavealpha($new_image, true);
		}
		
		@imagecopyresampled($new_image, $orig_image, 0, 0, 0, 0, $new_width, $new_height, $orig_width, $orig_height);
		
		@imagedestroy($orig_image);
		
		switch($img_data['mime'])
		{
			case 'image/jpeg': 
				$result = @imagejpeg($new_image, $output, $quality);break;
			case 'image/gif' : 
				$result = @imagegif($new_image, $output);break;
			case 'image/png' : 
				$result = @imagepng($new_image, $output);break;
			default: 
				$result = false;
		}
		
		@imagedestroy($new_image);
		
		return $result;
	}
	
	/**
	 * @since 1.3.2
	 * @ignore
	 */
	private function _check_memory_limit($required_space, $adjust = true)
	{
		$old_memory_limit = @ini_get("memory_limit");
		if($old_memory_limit === FALSE && $old_memory_limit !== NULL) # ???
			return false;
		
		if(!preg_match('/(\d+)[\s]*([a-z]+)/i', $old_memory_limit, $matches))
			return false; # ToDo: unlimited???
		
		$unit         = isset($matches[2]) ? strtolower($matches[2]) : '';
		$memory_limit = isset($matches[1]) ? intval($matches[1]) : 0;
		
		switch($unit)
		{
			case 'g':
			case 'gb':
				$memory_limit *= 1073741824;
				break;
			case 'm':
			case 'mb':
				$memory_limit *= 1048576;
				break;
			case 'k':
			case 'kb':
				$memory_limit *= 1024;
				break;
		}
		
		debug_buffer('Available space : ' . ($memory_limit - memory_get_usage()), 'GBFilePicker');
		
		if($memory_limit > 0 && ($memory_limit - memory_get_usage() <= $required_space))
		{
			if($adjust)
			{
				$memory_limit = (ceil((memory_get_usage() + $required_space) / 1048576) + 16) . 'M'; # + 16 = required memory for CMSms
				debug_buffer( 'Not enough memory. Try to adjust memory limit to : ' . $memory_limit, 'GBFilePicker');
				$ini_set = @ini_set('memory_limit', $memory_limit);
				if($ini_set === NULL || $ini_set === FALSE || $old_memory_limit == @ini_get("memory_limit"))
				{
					debug_buffer( 'Could not adjust memory limit. Skipping whatever i\'m about to do ...', 'GBFilePicker');
					return false;
				}
				return true;
			}
			debug_buffer( 'Not enough memory. Skipping whatever i\'m about to do ...', 'GBFilePicker');
			return false;
		}
		return true;
	}
	
	
	/**
	 * returns the calculated size of the thumbnail<br />
	 *
	 * @since 1.2
	 * @access public
	 *
	 * @param string $path - the source path of the image
	 * @return array - array(width,height)
	 */
	public function GetThumbnailSize($path)
	{
		$path = $this->CleanPath(str_replace(basename($path),'',$path)).basename($path);
		$img_data = @getimagesize($path);
		
		if (!$img_data)
		{
			return false;
		}
		
		$orig_width  = $img_data[0];
		$orig_height = $img_data[1];
		$aspectratio = $orig_width / $orig_height;
		
		$new_width  = floor(get_site_preference('thumbnail_width', 96));
		$new_height = floor(get_site_preference('thumbnail_height', 96));
		
		if($new_width <= 0)
		{
			$new_width = 96;
		}
		
		if($new_height <= 0)
		{
			$new_height = 96;
		}
		
		if($new_width > $orig_width)
		{
			$new_width = $orig_width;
		}
		if($new_height > $orig_height)
		{
			$new_height = $orig_height;
		}
		$new_aspectratio = $new_width / $new_height;
		
		if($aspectratio > 1 && $new_aspectratio < 1)
		{ // landscape to portrait
			$_tmp = floor($new_width / $aspectratio);
			if($_tmp > 0 && $_tmp <= $new_height)
			{
				$new_height = $_tmp;
			}
		}
		else if($aspectratio < 1 && $new_aspectratio > 1)
		{ // portrait to landscape
			$_tmp = floor($new_height * $aspectratio);
			if($_tmp > 0 && $_tmp <= $new_width)
			{
				$new_width = $_tmp;
			}
		}
		else
		{
			if($new_aspectratio < $aspectratio)
			{
				$_tmp = floor($new_width / $aspectratio);
				if($_tmp > 0 && $_tmp <= $new_height)
				{
					$new_height = $_tmp;
				}
			}
			else if($new_aspectratio > $aspectratio)
			{
				$_tmp = floor($new_height * $aspectratio);
				if($_tmp > 0 && $_tmp <= $new_width)
				{
					$new_width = $_tmp;
				}
			}
		}
		
		if($new_width < 1)
		{
			$new_width = 1;
		}
		if($new_height < 1)
		{
			$new_height = 1;
		}
		return array($new_width, $new_height);
	}
	
	
	/**
	 * Checks if a filename contains illegal chars<br />
	 * Taken from TinyMCE Module.
	 * @since 1.0
	 * @access public
	 * @param string $filename - the filename to check
	 * @return boolean
	 */
	public function ContainsIllegalChars($filename)
	{
		if (strpos($filename, '\'') !== false) return true;
		if (strpos($filename, '"' ) !== false) return true;
		if (strpos($filename, '/' ) !== false) return true;
		if (strpos($filename, '\\') !== false) return true;
		if (strpos($filename, '&' ) !== false) return true;
		if (strpos($filename, '\$') !== false) return true;
		if (strpos($filename, '+' ) !== false) return true;
		return false;
	}
	
	
	/**
	 * Checks if a var is empty. <br />
	 * If $var is an array it recursivley checks all elements.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param mixed &$var - the var to check for empty value(s)
	 * @param boolean $trim - true to trim off spaces
	 * @param boolean $unset_empty_indexes - true to delete empty elements from array
	 * @return boolean - true if empty, false if not
	 */
	public function IsVarEmpty(&$var, $trim = true, $unset_empty_indexes = false)
	{
		if (is_array($var))
		{
			foreach ($var as $k=>$v)
			{
				if (!$this->IsVarEmpty($v))
				{
					return false;
				}
				
				if($unset_empty_indexes)
				{
					unset($var[$k]);
				}
				return true;
			}
		}
		else if($trim && !is_object($var) && trim($var) == '')
		{
			return true;
		}
		else if($var == '')
		{
			return true;
		}
		return false;
	}
	
	
	/**
	 * Removes empty elements from an array. <br />
	 * (can be useful when using function explode to create the array from a csv)
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param array $array - the array to clean up
	 * @return array - an array without empty elements or an empty array
	 */
	public function CleanArray($array)
	{
		if (is_array($array))
		{
			foreach ($array as $k=>$v)
			{
				if ($this->IsVarEmpty($v,true,true))
				{
					unset($array[$k]);
				}
				else
				{
					if(is_array($v))
					{
						$v = $this->CleanArray($v);
						if($this->IsVarEmpty($v,true,true))
						{
							unset($array[$k]);
						}
						else
						{
							$array[$k] = $v;
						}
					}
				}
			}
			return $array;
		}
		return array();
	}
	
	
	/**
	 * Checks if a value is really meant to be "true". <br />
	 * Can be usefull when checking smarty params for the value true
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param mixed $value - the value to check
	 * @return bool
	 */
	public function IsTrue($value)
	{
		return (strtolower($value) === 'true' || $value === 1 || $value === '1' || $value === true);
	}
	
	
	/**
	 * Checks if a value is really meant to be "false". <br />
	 * Can be usefull when checking smarty params for the value false
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param mixed $value - the value to check
	 * @return bool
	 */
	public function IsFalse($value)
	{
		return (strtolower($value) === 'false' || $value === '0' || $value === 0 || $value === false || $value === '');
	}
	
	
	/**
	 * Indicates if GBFilePicker output is already done<br />
	 * can be useful to avoid ouput of javascript and css twice
	 *
	 * @since 1.1
	 * @access public
	 *
	 * @return bool - true if output done; false if not
	 */
	public function Loaded()
	{
		return $this->_loaded;
	}
	
	
	/**
	 * Processes given value using smarty
	 * @since 1.2.9
	 * @access public
	 *
	 * @param string $tpl - the value to process by smarty
	 * @return string - the processed value
	 * @ignore
	 */
	public function DoSmarty($tpl)
	{
		if(!is_array($tpl) && !is_object($tpl) && preg_match_all('/:::([^:]+):::/', $tpl, $matches))
		{
			if(isset($_GET['content_id']))
			{
				$manager =& cmsms()->GetHierarchyManager();
				$node = $manager->sureGetNodeByAlias($_GET['content_id']);
			}
			if(isset($node) && is_object($node))
			{
				$content =& $node->GetContent();
			}
			if(isset($content) && is_object($content) && $content->Type() != 'content2')
			{
				if(version_compare(CMS_VERSION, '1.9') < 0 && !isset(cmsms()->variables['pageinfo']->content_id))
				{
					// fake frontend rendering
					cmsms()->variables['pageinfo']                              = new stdClass();
					cmsms()->variables['pageinfo']->content_id                  = $content->mId;
					cmsms()->variables['pageinfo']->content_title               = $content->mName;
					cmsms()->variables['pageinfo']->content_alias               = $content->mAlias;
					cmsms()->variables['pageinfo']->content_menutext            = $content->mMenuText;
					cmsms()->variables['pageinfo']->content_titleattribute      = $content->mTitleAttribute;
					cmsms()->variables['pageinfo']->content_hierarchy           = $content->mHierarchy;
					cmsms()->variables['pageinfo']->content_id_hierarchy        = $content->mIdHierarchy;
					cmsms()->variables['pageinfo']->content_type                = $content->mType;
					cmsms()->variables['pageinfo']->content_props               = $content->mProperties->mPropertyNames;
					cmsms()->variables['pageinfo']->content_metadata            = $content->mMetadata;
					cmsms()->variables['pageinfo']->content_modified_date       = $content->mModifiedDate;
					cmsms()->variables['pageinfo']->content_created_date        = $content->mCreationDate;
					cmsms()->variables['pageinfo']->content_last_modified_date  = $content->mModifiedDate;
					cmsms()->variables['pageinfo']->content_last_modified_by_id = $content->mOwner;
					cmsms()->variables['pageinfo']->template_id                 = $content->mTemplateId;
					cmsms()->variables['pageinfo']->template_encoding           = get_encoding('');
					cmsms()->variables['pageinfo']->template_modified_date      = time(); // ???
					cmsms()->variables['pageinfo']->cachable                    = $content->mCachable;
					cmsms()->variables['pageinfo']->content_hierarchy_path      = $content->mHierarchyPath;
					
					cmsms()->variables['content_id']                            = $content->mId;
					cmsms()->variables['page']                                  = $content->mAlias;
					cmsms()->variables['page_id']                               = $content->mAlias;
					cmsms()->variables['page_alias']                            = $content->mAlias;
					cmsms()->variables['content_alias']                         = $content->mAlias;
					cmsms()->variables['page_name']                             = $content->mAlias;
					cmsms()->variables['position']                              = $content->mHierarchy;
					cmsms()->variables['friendly_position']                     = cmsms()->GetContentOperations()->CreateFriendlyHierarchyPosition($content->mHierarchy);
				}
				$smarty = cmsms()->GetSmarty();
				$smarty->assign_by_ref('content_obj', $content);
				$smarty->assign('content_id', $content->Id());
				$smarty->assign('content_alias', $content->Alias());
				$smarty->assign('page', $content->Alias());
				$smarty->assign('page_id', $content->Alias());
				$smarty->assign('page_alias', $content->Alias());
				$smarty->assign('page_name', $content->Alias());
				$smarty->assign('position', $content->Hierarchy());
				$smarty->assign('friendly_position', cmsms()->GetContentOperations()->CreateFriendlyHierarchyPosition($content->Hierarchy()));
			}
			#$tpl = $this->ProcessTemplateFromData(preg_replace('/:::([^:]+):::/', '{$1}', $tpl));
			$tpl = $smarty->fetch('string:' . preg_replace('/:::([^:]+):::/', '{$1}', $tpl));
		}
		return $tpl;
	}
	
	
	/**
	 * Returns a list of available themes
	 * @since 1.2.9
	 * @access public
	 * @return array - the themes
	 * @deprecated
	 */
	public function GetThemesList()
	{
		$dir = cms_join_path(dirname(__FILE__), 'templates', 'themes') . DIRECTORY_SEPARATOR;
		$d   = dir($dir);
		$default_themes = array();
		while ($entry = $d->read())
		{
			if ($entry[0] == '.' 
				|| !is_dir($dir.$entry)
				|| !file_exists(cms_join_path($dir.$entry,'input.tpl'))
				|| !file_exists(cms_join_path($dir.$entry,'fileBrowser.tpl'))
				|| !file_exists(cms_join_path($dir.$entry,'header.tpl')))
			{
				continue;
			}
			$default_themes[$entry] = $entry;
		}
		$d->close();
		asort($default_themes);
		return $default_themes;
	}
}
?>
