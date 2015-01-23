<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: CGEcommerceBase (c) 2010 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to provide a base communications
#  layer and common preference repository for his ecommerce suite of
#  modules for CMSMS.
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
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

$cgextensions = cms_join_path($gCms->config['root_path'],'modules',
			      'CGExtensions','CGExtensions.module.php');
if( !is_readable( $cgextensions ) )
{
  echo '<h1><font color="red">ERROR: The CGExtensions module could not be found.</font></h1>';
  return;
}
require_once($cgextensions);
///////////////////////////////////////////////////////////////////////////

define('CGECOMB_ATTRIB_ITEM_DESCRIPTION','{$attrib_text} ({$currency_symbol}{$attrib_adjust|number_format:2})');
class CGEcommerceBase extends CGExtensions
{
  /*---------------------------------------------------------
   Constructor()
   ---------------------------------------------------------*/
  function __construct()
  {
    parent::__construct();
    $this->cached_resources = NULL;
    $this->cached_event_types = NULL;
    $this->adminfuncs_loaded = false;
    $this->fefuncs_loaded = false;
    $this->commonfuncs_loaded = false;
    $this->searchfuncs_loaded = false;
  }


  /*---------------------------------------------------------
   AllowAutoInstall()
   ---------------------------------------------------------*/
  function AllowAutoInstall() {
    return FALSE;
  }


  /*---------------------------------------------------------
   AllowAutoUpgrade()
   ---------------------------------------------------------*/
  function AllowAutoUpgrade() {
    return FALSE;
  }


  /*---------------------------------------------------------
   GetName()
   ---------------------------------------------------------*/
  function GetName()
  {
    return 'CGEcommerceBase';
  }


  /*---------------------------------------------------------
   GetFriendlyName()
   ---------------------------------------------------------*/
  function GetFriendlyName()
  {
    return $this->Lang('friendlyname');
  }

	
  /*---------------------------------------------------------
   GetVersion()
   ---------------------------------------------------------*/
  function GetVersion()
  {
    return '1.3.11';
  }


  /*---------------------------------------------------------
   GetHelp()
   ---------------------------------------------------------*/
  function GetHelp()
  {
    return $this->Lang('help');
  }


  /*---------------------------------------------------------
   GetAuthor()
   ---------------------------------------------------------*/
  function GetAuthor()
  {
    return 'calguy1000';
  }


  /*---------------------------------------------------------
   GetAuthorEmail()
   ---------------------------------------------------------*/
  function GetAuthorEmail()
  {
    return 'calguy1000@cmsmadesimple.org';
  }


  /*---------------------------------------------------------
   GetChangeLog()
   ---------------------------------------------------------*/
  function GetChangeLog()
  {
    $txt = @file_get_contents(dirname(__FILE__).'/changelog.inc');
    return $txt;
  }
  

  /*---------------------------------------------------------
   IsPluginModule()
   ---------------------------------------------------------*/
  function IsPluginModule()
  {
    return false;
  }


  /*---------------------------------------------------------
   HasAdmin()
   ---------------------------------------------------------*/
  function HasAdmin()
  {
    return true;
  }


  /*---------------------------------------------------------
   GetAdminSection()
   ---------------------------------------------------------*/
  function GetAdminSection()
  {
    return 'ecommerce';
  }


  /*---------------------------------------------------------
   GetAdminDescription()
   ---------------------------------------------------------*/
  function GetAdminDescription()
  {
    return $this->Lang('module_description');
  }


  /*---------------------------------------------------------
   VisibleToAdminUser()
   ---------------------------------------------------------*/
  function VisibleToAdminUser()
  {
    return  $this->CheckPermission('Modify Site Preferences');
  }


  /*---------------------------------------------------------
   GetDependencies()
   ---------------------------------------------------------*/
  function GetDependencies()
  {
    return array('CGExtensions'=>'1.26.6');
  }


  /*---------------------------------------------------------
   MinimumCMSVersion()
   ---------------------------------------------------------*/
  function MinimumCMSVersion()
  {
    return "1.9.2";
  }
	
	
  /*---------------------------------------------------------
   GetHeaderHTML()
   ---------------------------------------------------------*/
  function GetHeaderHTML()
  {
    $obj = $this->GetModuleInstance('JQueryTools');
    $txt = '';
    if( is_object($obj) )
      {
$tmpl = <<<EOT
{JQueryTools action='incjs' exclude='form'}
{JQueryTools action='ready'}
EOT;
        $txt .= $this->ProcessTemplateFromData($tmpl);
      }

    return $txt;
  }	


  /*---------------------------------------------------------
   SetParameters()
   ---------------------------------------------------------*/
  function SetParameters()
  {
    $this->RestrictUnknownParams();
    $this->RegisterModulePlugin();
    $this->AddImageDir('icons');

    cgecomm_smarty::init();
  }


  /*---------------------------------------------------------
   InstallPostMessage()
   ---------------------------------------------------------*/
  function InstallPostMessage()
  {
    return $this->Lang('postinstall');
  }


  /*---------------------------------------------------------
   UninstallPostMessage()
   ---------------------------------------------------------*/
  function UninstallPostMessage()
  {
    return $this->Lang('postuninstall');
  }


  /*---------------------------------------------------------
   UninstallPreMessage()
   ---------------------------------------------------------*/
  function UninstallPreMessage()
  {
    return $this->Lang('ask_really_uninstall');
  }	


  /*---------------------------------------------------------
   GetEventHelp()
   ---------------------------------------------------------*/
  function GetEventHelp($event_name)
  {
    return $this->Lang('event_help_'.$event_name);
  }	


  /*---------------------------------------------------------
   GetEventDescription()
   ---------------------------------------------------------*/
  function GetEventDescription($event_name)
  {
    return $this->Lang('event_desc_'.$event_name);
  }	
} // end of class

#
# EOF
#
?>
