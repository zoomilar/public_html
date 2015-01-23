<?php

# Module: Extended Content Blocks
# Zdeno Kuzmany (zdeno@kuzmany.biz) / kuzmany.biz  / twitter.com/kuzmany
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2009 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
# The module's homepage is: http://dev.cmsmadesimple.org/projects/skeleton/
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
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


define('USE_ECB', 'Use Extended Content Blocks');

class ECB extends CGExtensions {

    public function __construct() {
        parent::__construct();
    }

    public function AllowAutoUpgrade() {
        return TRUE;
    }

    function InitializeFrontend() {
        $this->RegisterModulePlugin();
        $this->RestrictUnknownParams();
        
        $this->SetParameterType('block_name', CLEAN_STRING);
        $this->SetParameterType('value', CLEAN_STRING);
        $this->SetParameterType('adding', CLEAN_STRING);
        $this->SetParameterType('sortfiles', CLEAN_STRING);
        $this->SetParameterType('excludeprefix', CLEAN_STRING);
        $this->SetParameterType('recurse', CLEAN_STRING);
        $this->SetParameterType('filetypes', CLEAN_STRING);
        $this->SetParameterType('field', CLEAN_STRING);
        $this->SetParameterType('dir', CLEAN_STRING);
        $this->SetParameterType('preview', CLEAN_STRING);
        $this->SetParameterType('date_format', CLEAN_STRING);
        
    }

    function InitializeAdmin() {
        $this->AddImageDir('icons');
    }

    function LazyLoadFrontend() {
        return TRUE;
    }

    public function GetName() {
        return 'ECB';
    }

    public function GetFriendlyName() {
        return $this->Lang('friendlyname');
    }

    public function GetVersion() {
        return '1.5';
    }

    public function GetHelp() {
        return $this->Lang('help');
    }

    public function GetAuthor() {
        return 'Zdeno Kuzmany (twitter.com/kuzmany)';
    }

    public function GetAuthorEmail() {
        return 'zdeno@kuzmany.biz';
    }

    public function GetChangeLog() {
         return file_get_contents(dirname(__file__) . '/changelog.inc');
    }

    public function HasAdmin() {
        return TRUE;
    }

    public function GetAdminSection() {
        return 'extensions';
    }

    public function GetAdminDescription() {
        return $this->Lang('admindescription');
    }

    public function VisibleToAdminUser() {
        return ($this->CheckAccess());
    }

    public function CheckAccess($perm = USE_ECB) {
        return $this->CheckPermission($perm);
    }

    public function GetDependencies() {
        return array('CGExtensions' => '1.31');
    }

    public function MinimumCMSVersion() {
        return "1.11.3";
    }

    public function InstallPostMessage() {
        return $this->Lang('postinstall');
    }

    public function UninstallPostMessage() {
        return $this->Lang('postuninstall');
    }

    public function UninstallPreMessage() {
        return $this->Lang('really_uninstall');
    }

    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#HasCapability
     * @ignore
     */
    function HasCapability($capability, $params = array()) {
        switch ($capability) {
            case 'contentblocks':
            case 'content_attributes':
                return TRUE;
            default:
                return FALSE;
        }
    }

    // content block
    public function GetContentBlockInput($blockName, $value, $params, $adding=false) {
        $ecb = new ecb_tools($blockName, $value, $params, $adding);
        return $ecb->get_content_block_input();
    }

}

?>
