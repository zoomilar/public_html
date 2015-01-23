<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGSmartImage (c) 2011 by Robert Campbell (calguy1000@cmsmadesimple.org)
#  
#  An addon module for CMS Made Simple to allow creating image tags in a smart
#  way to optimize performance.
# 
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005-2010 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# However, as a special exception to the GPL, this software is distributed
# as an addon module to CMS Made Simple.  You may not use this software
# in any Non GPL version of CMS Made simple, or in any version of CMS
# Made simple that does not indicate clearly and obviously in its admin 
# section that the site was built with CMS Made simple.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
#END_LICENSE

class CGSmartImage extends CGExtensions
{
  public function __construct()
  {
    parent::__construct();
    $this->RegisterModulePlugin(); // this is here so the module can be used from the admin.
  }

  function LazyLoadAdmin() { return FALSE; }
  function LazyLoadFrontend() { return FALSE; }
  function GetName() { return get_class($this); }
  function GetFriendlyName() { return $this->Lang('friendlyname');  }
  function GetVersion() { return '1.10.1'; }
  function MinimumCMSVersion() { return '1.11.2'; }
  function GetDependencies() { return array('CGExtensions'=>'1.31');   }
  function GetAuthor() { return 'calguy1000'; }
  function GetAuthorEmail() { return 'calguy1000@gmail.com'; }
  function IsPluginModule() { return true; }
  function GetAdminSection() { return 'extensions'; }
  function HandlesEvents () { return false; }
  function HasAdmin() { return true; }
  function VisibleToAdminUser() { return $this->CheckPermission('Modify Site Preferences'); }
  
  
  public function InitializeFrontend()
  {
    parent::SetParameters();
    $this->RestrictUnknownParams();

    // operational params (what to do, with what...)

    $this->SetParameterType('noautoscale',CLEAN_INT);
    $this->SetParameterType('nobcache',CLEAN_INT);
    $this->SetParameterType('noembed',CLEAN_INT);
    $this->SetParameterType('noauto',CLEAN_INT);
    $this->SetParameterType('norotate',CLEAN_INT);
    $this->SetParameterType('notag',CLEAN_INT);
    $this->SetParameterType('noresponsive',CLEAN_INT);
    $this->SetParameterType('noremote',CLEAN_INT);
    $this->SetParameterType('src',CLEAN_STRING);
    $this->SetParameterType('overwrite',CLEAN_INT);

    // params for the output tag (if outputting an img tag)
    $this->SetParameterType('id',CLEAN_STRING);
    $this->SetParameterType('class',CLEAN_STRING);
    $this->SetParameterType('style',CLEAN_STRING);
    $this->SetParameterType('title',CLEAN_STRING);
    $this->SetParameterType('alt',CLEAN_STRING);
    $this->SetParameterType('name',CLEAN_STRING);
    $this->SetParameterType('height',CLEAN_INT);
    $this->SetParameterType('width',CLEAN_INT);
    $this->SetParameterType('max_height',CLEAN_INT);
    $this->SetParameterType('max_width',CLEAN_INT);
    $this->SetParameterType('quality',CLEAN_INT);
    $this->SetParameterType('rel',CLEAN_STRING);

    $this->SetParameterType(CLEAN_REGEXP.'/src\d*/',CLEAN_STRING);
    $this->SetParameterType(CLEAN_REGEXP.'/alias\d*/',CLEAN_STRING);
    $this->SetParameterType(CLEAN_REGEXP.'/filter_\w*/',CLEAN_STRING);
    $this->SetParameterType('silent',CLEAN_INT);

    // more smarty plugins
    $smarty = cmsms()->GetSmarty();
    $smarty->register_block('cgsi_convert',array('cgsi_utils','cgsi_convert'));
  }

  function InitializeAdmin()
  {
    $this->CreateParameter('silent','',$this->Lang('param_silent'));
    $this->CreateParameter('alias','',$this->Lang('param_alias'));
    $this->CreateParameter('noautoscale','',$this->Lang('param_noautoscale'));
    $this->CreateParameter('nobcache','',$this->Lang('param_nobcache'));
    $this->CreateParameter('noembed','',$this->Lang('param_noembed'));
    $this->CreateParameter('noauto','',$this->Lang('param_noauto'));
    $this->CreateParameter('norotate','',$this->Lang('param_norotate'));
    $this->CreateParameter('notag','',$this->Lang('param_notag'));
    $this->CreateParameter('noresponsive','',$this->Lang('param_noresponsive'));
    $this->CreateParameter('nobreakpoints','',$this->Lang('param_nobreakpoints'));
    $this->CreateParameter('noremote','',$this->Lang('param_noremote'));
    $this->CreateParameter('src','',$this->Lang('param_src'),false);
    $this->CreateParameter('overwrite','',$this->Lang('param_overwrite'));
    $this->CreateParameter('id','',$this->Lang('param_id'));
    $this->CreateParameter('class','',$this->Lang('param_class'));
    $this->CreateParameter('style','',$this->Lang('param_style'));
    $this->CreateParameter('title','',$this->Lang('param_title'));
    $this->CreateParameter('alt','',$this->Lang('param_alt'));
    $this->CreateParameter('name','',$this->Lang('param_name'));
    $this->CreateParameter('height','',$this->Lang('param_height'));
    $this->CreateParameter('width','',$this->Lang('param_width'));
    $this->CreateParameter('quality','75',$this->Lang('param_quality'));
    $this->CreateParameter('rel','75',$this->Lang('param_rel'));
    $this->CreateParameter('max_width','',$this->Lang('param_max_width'));
    $this->CreateParameter('max_height','',$this->Lang('param_max_height'));
    $this->CreateParameter('filter_blur','',$this->Lang('param_filter_blur'));
    $this->CreateParameter('filter_brightness','',$this->Lang('param_filter_brightness'));
    $this->CreateParameter('filter_colorize','',$this->Lang('param_filter_colorize'));
    $this->CreateParameter('filter_contrast','',$this->Lang('param_filter_contrast'));
    $this->CreateParameter('filter_crop','',$this->Lang('param_filter_crop'));
    $this->CreateParameter('filter_croptofit','',$this->Lang('param_filter_croptofit'));
    $this->CreateParameter('filter_edgedetect','',$this->Lang('param_filter_edgedetect'));
    $this->CreateParameter('filter_emboss','',$this->Lang('param_filter_emboss'));
    $this->CreateParameter('filter_flip','',$this->Lang('param_filter_flip'));
    $this->CreateParameter('filter_grayscale','',$this->Lang('param_filter_grayscale'));
    $this->CreateParameter('filter_meanremoval','',$this->Lang('param_filter_meanremoval'));
    $this->CreateParameter('filter_negate','',$this->Lang('param_filter_negate'));
    $this->CreateParameter('filter_pixelate','',$this->Lang('param_filter_pixelate'));
    $this->CreateParameter('filter_reflect','',$this->Lang('param_filter_reflect'));
    $this->CreateParameter('filter_resize','',$this->Lang('param_filter_resize'));
    $this->CreateParameter('filter_resizetofit','',$this->Lang('param_filter_resizetofit'));
    $this->CreateParameter('filter_rotate','',$this->Lang('param_filter_rotate'));
    $this->CreateParameter('filter_roundedcorners','',$this->Lang('param_filter_roundedcorners'));
    $this->CreateParameter('filter_watermark','',$this->Lang('param_filter_watermark'));
    $this->CreateParameter('filter_reflect','',$this->Lang('param_filter_reflect'));
  }

  function GetHelp() 
  { 
    return file_get_contents(dirname(__FILE__).'/help.inc');
  }

  function GetAdminDescription()
  {
    return $this->Lang('moddescription');
  }
  
  function GetChangeLog()
  {
    return @file_get_contents(dirname(__FILE__).'/changelog.html.inc');
  }

  function InstallPostMessage()
  {
    return $this->Lang('postinstall');
  }

  function UninstallPostMessage()
  {
    return $this->Lang('postuninstall');
  }

  protected function can_smart_embed($src)
  {
    global $CMS_ADMIN_PAGE;
    global $CMS_STYLESHEET;

    $imagsize = filesize($src);

    $browser = cge_utils::get_browser();
    switch( $browser->getBrowser() )
      {
      case Browser::BROWSER_IE:
	$ver = $browser->getVersion();
	if( $ver <= 7 ) return FALSE;
	if( $CMS_STYLESHEET && $ver < 8 ) return FALSE;
	if( $ver == 8 && $imagsize >= 32*1024 ) return FALSE;
	return TRUE;

      default:
	return TRUE;
      }
  }

  public function can_embed($src)
  {
    if( !is_readable($src) ) return FALSE;

    $e_mode = $this->GetPreference('embed_mode');
    $e_sizelimit = (int)$this->GetPreference('embed_size');
    $e_types = $this->GetPreference('embed_types');

    switch( $e_mode )
      {
      case 'smart':
	return $this->can_smart_embed($src);

      case 'smart_limited':
	if( $e_sizelimit <= 0 || $e_sizelimit > 10000 ) return FALSE;
	$e_sizelimit *= 1024;
	$tmp = filesize($src);
	if( $tmp > $e_sizelimit ) return FALSE;
	return $this->can_smart_embed($src);
	break;
	
      case 'sizelimit':
	// check the limit.
	if( $e_sizelimit <= 0 || $e_sizelimit > 10000 ) return FALSE;
	$e_sizelimit *= 1024;
	
	// get the filesize
	$tmp = filesize($src);
	if( $tmp > $e_sizelimit ) return FALSE;
	return TRUE;

      case 'type':
	if( !$e_types ) return FALSE;
	$types = explode(',',$e_types);
	$ext = strrchr($file['name'],'.');
	if( !$ext ) return FALSE;
	foreach( $types as $type )
	  {
	    if( '.'.strtolower($type) == strtolower($extension) ) return TRUE;
	  }
	return FALSE;
	break;

      case 'none':
      default:
	return FALSE;
      }
  }

  public function clear_cached_files()
  {
    $config = cmsms()->GetConfig();
	$cache_path = $this->GetPreference('cache_path', cms_join_path('uploads', '_'.$this->GetName()));
	$dir = cms_join_path($config['root_path'], $cache_path);
    $age_days = (int)$this->GetPreference('cache_age');
    if( $age_days <= 0 )
      {
	throw new Exception($this->Lang('error_invalid_age'));
      }
	  
    $thedate = time() - $age_days * 24 * 60 * 60;
    $n_removed = 0;
    if( $dh = opendir($dir) ) 
      {
	while( ($file = readdir($dh)) !== false )
	  {
	    if( startswith($file,'.') ) continue; // ignore hidden files.
	    $fn = cms_join_path($dir,$file);
	    if( filemtime($fn) < $thedate && is_file($fn) )
	      {
		@unlink($fn);
		$n_removed++;
	      }
	  }
	closedir($dh);
      }
    return $n_removed;
  }

  public function HasCapability($capability, $params = array())
  {
    if( $capability == 'tasks' ) return TRUE;
    return FALSE;
  }

  public function get_tasks()
  {
    return new CGSmartImage_ClearCacheTask();
  }

  public function get_cached_image_url($filename)
  {
    $config = cmsms()->GetConfig();
    $prefix = trim($this->GetPreference('image_url_prefix'));
    if( !$prefix || !startswith($prefix,$config['root_url']) )
      $prefix = $config['root_url'];
    $hascachedir = $this->GetPreference('image_url_hascachedir');

    $url = $prefix;
    if( !endswith($url,'/') ) $url .= '/';
    if( !$hascachedir ) {
	
		$cache_url = $this->GetPreference('cache_path', cms_join_path('uploads', '_'.$this->GetName()));
		$cache_url = str_replace(DIRECTORY_SEPARATOR, '/', $cache_url); // <- Ensure correct slashes for URL
		$url .= $cache_url;
	}
    if( !endswith($url,'/') ) $url .= '/';
    $url .= $filename;
    return $url;
  }

} // end of class

?>
