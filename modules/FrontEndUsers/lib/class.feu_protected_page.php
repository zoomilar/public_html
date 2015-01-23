<?php
#BEGIN_LICENSE
#-------------------------------------------------------------------------
# Module: FrontEndUsers (c) 2008 by Robert Campbell 
#         (calguy1000@cmsmadesimple.org)
#  An addon module for CMS Made Simple to allow management of frontend
#  users, and their login process within a CMS Made Simple powered 
#  website.
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

class feu_protected_page extends Content
{
  private $_data;
  const FEU_PROPNAME = '__feu_date__'; // oops: typo, can't change it now though.

  private function _getData()
  {
    if( !is_array($this->_data) ) {
      $tmp = $this->GetPropertyValue(self::FEU_PROPNAME);
      if( $tmp ) {
	$this->_data = unserialize($tmp);
      }
      else {
	$this->_data = array();
      }
    }
  }

  private function _setData()
  {
    if( is_array($this->_data) && count($this->_data) ) {
      $this->SetPropertyValue(self::FEU_PROPNAME,serialize($this->_data));
    }
    else {
      $this->SetPropertyValue(self::FEU_PROPNAME,'');
    }
  }

  private function _isAuthorized()
  {
    // do we have access to it?
    $this->_getData();
    
    $feu = cms_utils::get_module('FrontEndUsers');
    if( !$feu ) return FALSE;
    $uid = $feu->LoggedInId();
    if( !$uid ) return FALSE; // not logged in is a false.

    if( !isset($this->_data['groups']) || 
	count($this->_data['groups']) == 0 ) {
      // no member groups selected, but still logged in, we can display this.
      return TRUE;
    }

    // get member groups and do a cross reference.
    $groups = $feu->GetMemberGroupsArray($uid);
    if( !is_array($groups) || count($groups) == 0 ) return FALSE;
    $membergroups = cge_array::extract_field($groups,'groupid');
    for( $i = 0; $i < count($this->_data['groups']); $i++ ) {
      if( in_array($this->_data['groups'][$i],$membergroups) )
	return TRUE;
    }

    // no match.
    return FALSE;
  }

  public function FriendlyName()
  {
    return cms_utils::get_module('FrontEndUsers')->Lang(get_class());
  }

  public function SetProperties()
  {
    parent::SetProperties();
    $this->AddExtraProperty(self::FEU_PROPNAME);
    $this->RemoveProperty('cachable',false);
  }

  public function Show($param = '')
  {
	//echo 'zzz'; die;
    if( !$this->_isAuthorized() ) {
		$feu = cms_utils::get_module('FrontEndUsers');
		$action = $feu->GetPreference('pagetype_action','showlogin');
		if (!isset($_COOKIE['last_url'])) {
			setcookie('last_url',$_SERVER['REQUEST_URI'],time()+3600,"/");
		}
		// now what do we do.
		switch( $action ) {
			case 'redirect':
				$page = $feu->GetPreference('pagetype_redirectto',-1);
				if( $page == -1 ) {
					return $feu->Lang('pagetype_unauthorized');
				}
				else {
					redirect_to_alias($page);
				}
			break;

			case 'showlogin':
			default:
				if( $param != 'content_en' ) return;
				$this->_getData();
				$tmp = array('form'=>'login');
				if( isset($this->_data['captcha']) && $this->_data['captcha'] == 0 ) {
					$tmp['nocaptcha'] = 1;
				}
				@ob_start();
				$feu->DoAction('default','cntnt01',$tmp,$this->Id());
				$out = @ob_get_contents();
				@ob_end_clean();
				return $out;
			break;
		}
    }

    return parent::Show($param);
  }

  public function TabNames()
  {
    $res = parent::TabNames();
    if( check_permission(get_userid(),'Manage All Content') ) {
      $res[] = cms_utils::get_module('FrontEndUsers')->Lang('permissions');
    }
    return $res;
  }

  public function FillParams($params,$editing = false)
  {
    $this->_getData();
    if( isset($params['__feu_groups__']) ) {
      $this->_data['groups'] = $params['__feu_groups__'];
    }
    else if( isset($this->_data['groups']) ) {
      unset($this->_data['groups']);
    }
    if( isset($params['__feu_captcha__']) ) {
      $this->_data['captcha'] = $params['__feu_captcha__'];
    }
    parent::FillParams($params,$editing);
    $this->SetCachable(false);
  }

  public function EditAsArray($adding = false, $tab = 0, $showadmin = false)
  {
    if( $tab < 2 ) {
      return parent::EditAsArray($adding,$tab,$showadmin);
    }

    $ret = array();
    // the permissions tab.
    $feu = cms_utils::get_module('FrontEndUsers');
    $grouplist = array_flip($feu->GetGroupList());

    $this->_getData();
    if( !isset($this->_data['groups']) ) {
      $tmp = explode(',',$feu->GetPreference('pagetype_groups'));
      if( is_array($tmp) && count($tmp) ) $this->_data['groups'] = $tmp;
    }
    $size = min(count($grouplist),10);
    $tmp = array($feu->Lang('groups').':');
    $opt = '<select name="__feu_groups__[]" multiple="multiple" size="'.$size.'">';
    foreach( $grouplist as $gid => $gname ) {
      $selected = '';
      if( isset($this->_data['groups']) && 
	  in_array($gid,$this->_data['groups']) ) {
	$selected='selected="selected" ';
      }
      $opt .= '<option '.$selected.'value="'.$gid.'">'.$gname.'</option>';
    }
    $opt .= '</select><br/>'.$feu->Lang('info_contentpage_grouplist');
    $tmp[] = $opt;
    $ret[] = $tmp;
    
    $captcha = $feu->GetModuleInstance('Captcha');
    if( is_object($captcha) ) {
      $val = (isset($this->_data['captcha']))?$this->_data['captcha']:1;
      $tmp = array($feu->Lang('enable_captcha').':');
      $tmp[] = $feu->CreateInputYesNoDropdown('','__feu_captcha__',$val).'<br/>'.$feu->Lang('info_enable_captcha');
      $ret[] = $tmp;
    }
    return $ret;
  }

  public function ShowInMenu()
  {
    $res = parent::ShowInMenu();
    if( !$res ) return $res;

    return $this->_isAuthorized();
  }

  public function Save()
  {
    $this->_setData();
    return parent::Save();
  }
} // end of class

#
# EOF
#
?>