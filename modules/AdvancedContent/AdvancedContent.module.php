<?php
#-------------------------------------------------------------------------------
#
# Module : AdvancedContent (c) 2010-2013 by Georg Busch (georg.busch@gmx.net)
#          a content management tool for CMS Made Simple
#          The projects homepage is dev.cmsmadesimple.org/projects/content2/
#          CMS Made Simple is (c) 2004-2013 by Ted Kulp
#          The projects homepage is: cmsmadesimple.org
# Version: 0.9.4
# File   : AdvancedContent.module.php
# Purpose: initial module class.
# License: GPL
#
#-------------------------------------------------------------------------------

if(!defined('AC_BLOCK_PATTERN'))
	define('AC_BLOCK_PATTERN', '/{((AdvancedContent|content(_image|_module)?)((?!_)[^}]*))}/i');
if(!defined('AC_BLOCK_PARAM_PATTERN'))
	define('AC_BLOCK_PARAM_PATTERN', '/([\w]+)=(["][^"]*["]|[\'][^\']*[\']|[^\'"\s]*)/');
if(!defined('AC_INVALID_BLOCK_TYPE'))
	define('AC_INVALID_BLOCK_TYPE', '---invalid---');

class AdvancedContent extends CMSModule
{
	private $_pp = 'PGRpdiBzdHlsZT0iZmxvYXQ6cmlnaHQiPjxmb3JtIGFjdGlvbj0iaHR0cHM6Ly93d3cucGF5cGFsLmNvbS9jZ2ktYmluL3dlYnNjciIgbWV0aG9kPSJwb3N0Ij48aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJjbWQiIHZhbHVlPSJfcy14Y2xpY2siIC8+PGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iaG9zdGVkX2J1dHRvbl9pZCIgdmFsdWU9IkZBMkQzRlBMU1RBS0oiIC8+PGlucHV0IHR5cGU9ImltYWdlIiBzcmM9Imh0dHBzOi8vd3d3LnBheXBhbC5jb20vZW5fR0IvaS9idG4vYnRuX2RvbmF0ZV9MRy5naWYiIGJvcmRlcj0iMCIgbmFtZT0ic3VibWl0IiBhbHQ9IlBheVBhbCAtIFRoZSBzYWZlciwgZWFzaWVyIHdheSB0byBwYXkgb25saW5lLiIgLz48aW1nIGFsdD0iIiBib3JkZXI9IjAiIHNyYz0iaHR0cHM6Ly93d3cucGF5cGFsLmNvbS9kZV9ERS9pL3Njci9waXhlbC5naWYiIHdpZHRoPSIxIiBoZWlnaHQ9IjEiIC8+PC9mb3JtPjwvZGl2Pg==';
	
	public function __construct()
	{
		parent::__construct();
		if(!$this->GetPreference('hide_deprecated', 0))
		{
			$this->RegisterContentType(
				'Content2', 
				dirname(__FILE__) . '/lib/class.Content2.php', 
				'AdvancedContent (deprecated)'
			);
		}
		$this->RegisterContentType(
			'advanced_content', 
			dirname(__FILE__) . '/lib/class.advanced_content.php', 
			$this->lang('AdvancedContent')
		);
		
		$smarty = &cmsms()->GetSmarty();
		$smarty->registerPlugin('function', 'get_global_contents',
			array('ac_smarty_plugins', 'get_global_contents'));
	}
	
	public function GetName()
	{
		return get_class($this);
	}
	
	public function GetFriendlyName()
	{
		return $this->GetPreference('friendly_name', $this->Lang($this->GetName()));
	}
	
	public function GetVersion()
	{
		return '0.9.4.3';
	}
	
	public function GetHelp()
	{
		if((isset($_GET['action']) && $_GET['action'] == 'showmodulehelp') 
			|| (isset($_POST['name']) && $_POST['name'] == $this->GetName()))
		{
			$block_help = array();
			foreach(ac_admin_ops::GetCustomBlockTypes() as $blockType)
				$block_help[] = $blockType->GetHelp();
			
			$block_help = implode('<div class="pageheader"></div>', $block_help);
			
			$help_file = dirname(__FILE__) . '/doc/help_' . $this->curlang . '.html';
			if(!is_file($help_file))
				$help_file = dirname(__FILE__) . '/doc/help_en_US.html';
			
			$helptext = $this->_pp();
			
			if($block_help)
			{
				$helptext .= $this->StartTabHeaders() . $this->SetTabHeader('help', lang('help'), true);
				$helptext .= $this->SetTabHeader('custom_blocktypes', $this->lang('custom_blocktypes'), false);
				$helptext .= $this->EndTabHeaders() . $this->StartTabContent() . $this->StartTab('help');
			}
			
			$helptext .= file_get_contents($help_file);
			
			if($block_help)
			{
				$helptext .= $this->EndTab();
				$helptext .= $this->StartTab('custom_blocktypes') . $block_help . $this->EndTab();
				$helptext .= $this->EndTabContent();
			}
			return $helptext;
		}
		return true;
	}
	
	public function GetAuthor()
	{
		return 'Georg Busch (NaN)';
	}
	
	/**
	 * @todo plugin changelog
	 */
	public function GetChangeLog()
	{
		if((isset($_GET['action']) && $_GET['action'] == 'showmoduleabout')
			|| (isset($_POST['name']) && $_POST['name'] == $this->GetName()))
		{
			$blockChangeLog = array();
			foreach(ac_admin_ops::GetCustomBlockTypes() as $blockType)
				$blockChangeLog[] = $blockType->GetChangeLog();
			
			$blockChangeLog = implode('',$blockChangeLog);
			$changeLog      = $this->_pp();
			if($blockChangeLog)
			{
				$changeLog .=
					$this->StartTabHeaders() .
						$this->SetTabHeader('help', lang('help'), true) .
						$this->SetTabHeader('custom_blocktypes', $this->lang('custom_blocktypes'), false) .
					$this->EndTabHeaders() .
					$this->StartTabContent() . 
						$this->StartTab('help');
			}
			$changeLog .= file_get_contents(dirname(__FILE__) . '/doc/changelog.html');
			if($blockChangeLog)
			{
				$changeLog .= 
						$this->EndTab() .
						$this->StartTab('custom_blocktypes') . 
							$blockChangeLog . 
						$this->EndTab() .
					$this->EndTabContent();
			}
			return $changeLog;
		}
		return true;
	}
	
	public function HasContentType()
	{
		return true;
	}
	
	public function IsPluginModule()
	{
		return true;
	}
	
	public function HasAdmin()
	{
		return true;
	}
	
	public function GetAdminSection()
	{
		return $this->GetPreference('admin_section', 'extensions');
	}
	
	public function GetAdminDescription()
	{
		return $this->lang('admindescription');
	}
	
	public function VisibleToAdminUser()
	{
		return $this->CheckPermission('Manage AdvancedContent Preferences') || $this->CheckPermission('Manage AdvancedContent MultiInputs') || $this->CheckPermission('Manage AdvancedContent MultiInput Templates');
	}
	
	public function MinimumCMSVersion()
	{
		return "1.8";
	}
	
	public function MaximumCMSVersion()
	{
		return "1.12";
	}
	
	public function InstallPostMessage()
	{
		return $this->Lang('postinstall', $this->GetVersion());
	}
	
	public function UninstallPostMessage()
	{
		return $this->Lang('postuninstall', $this->GetVersion());
	}
	
	public function UninstallPreMessage()
	{
		return $this->Lang('confirmuninstall');
	}
	
	public function HandlesEvents()
	{
		return true;
	}
	
	public function DoAction($action, $id, $params, $returnid = '')
	{
		switch($action) {
			case 'deleteMultiInput':
			case 'deleteMultiInputTpl':
			case 'default':
			case 'savePrefs':
			case 'defaultadmin':
			case 'addMultiInput':
			case 'editMultiInput':
			case 'addMultiInputTpl':
			case 'editMultiInputTpl':
				parent::DoAction($action, $id, $params, $returnid);
				break;
			default: break;
		}
	}
	
	public function InitializeFrontend()
	{
		$this->RegisterModulePlugin();
		$this->SetParameters();
	}
	
	public function InitializeAdmin()
	{
		$this->SetParameters();
	}
	
	public function SetParameters()
	{
		# get rid of annoying admin logs!
		$this->RestrictUnknownParams();
		$this->SetParameterType(CLEAN_REGEXP . '/.*/', CLEAN_NONE);
	}
	
	public function GetHeaderHTML()
	{
		$config = cmsms()->GetConfig();
		if(version_compare(CMS_VERSION, '1.11') < 0)
		{
			# backward compatibility
			if(version_compare(CMS_VERSION, '1.9') < 0)
				$this->smarty->assign('bc', true);
			
			$this->smarty->assign('jq_ui_css', $config['root_url'] . '/modules/' . $this->GetName() . '/css/jquery-ui/base/jquery.ui.all.css');
			$themeName = get_class(cmsms()->variables['admintheme']);
			if(endswith($themeName, 'Theme'))
				$themeName = substr($themeName, 0, strlen($themeName)-5);
			$admin_url = $config['root_url'] . '/' . $config['admin_dir'];
		}
		else 
		{
			$themeName = cms_utils::get_theme_object()->themeName;
			$admin_url = $config['admin_url'];
		}
		$this->smarty->assign('expand_img', 
			$admin_url . '/themes/' . $themeName . '/images/icons/system/expand.gif',
			'','','','systemicon'
		);
		$this->smarty->assign('contract_img', 
			$admin_url . '/themes/' . $themeName . '/images/icons/system/contract.gif',
			'','','','systemicon'
		);
		$this->smarty->assign('module_id', 'm1_');
		$this->smarty->assign('debug', $config['debug']);
		$this->smarty->assign('locale', substr(get_preference(get_userid(),'default_cms_language'), 0, 2));
		return $this->ProcessTemplate('header.tpl');
	}
	
	public function LazyLoadFrontend()
	{
		return true;
	}
	
	public function LazyLoadAdmin()
	{
		return true;
	}
	
	protected final function _pp()
	{
		return base64_decode($this->_pp);
	}
}

function AdvancedContent_Autoloader($classname)
{
	$config = cmsms()->GetConfig();
	$fn1    = cms_join_path($config['root_path'], 'module_custom', 'AdvancedContent', 'lib', 'class.'.$classname.'.php');
	$fn2    = cms_join_path(dirname(__FILE__), 'lib', 'class.'.$classname.'.php');
	if( is_file($fn1) )
	{
		require_once($fn1);
		return TRUE;
	}
	if( is_file($fn2) )
	{
		require_once($fn2);
		return TRUE;
	}
	return FALSE;
}
spl_autoload_register('AdvancedContent_Autoloader');

?>
